<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;


use App\Http\Resources\ProductSmallResource;

use \App\Models\Override\Product;

class ProductController extends \App\Http\Controllers\Controller
{ 

  private const ATTR_IDS = [
    'stimulation' => 5, 
    'relaxation' => 6, 
    'euphoria' => 7
  ];

  public function similar(Request $request) {
    $data = $request->only(['stimulation', 'relaxation', 'euphoria']);

    $params = array_map(function($param){
			return $param * 20;
		}, $data);

    $products = $this->relatedItems($params);

    return ProductSmallResource::collection($products);
  }

  private function relatedItems($params){

		$related_array = DB::select('
					select pr.id, 
							(ABS(MAX(IF(ap.attribute_id = :sId, ap.value, 0)) - :stimulation) +
							 ABS(MAX(IF(ap.attribute_id = :rId, ap.value, 0)) - :relaxation) +
							 ABS(MAX(IF(ap.attribute_id = :eId, ap.value, 0)) - :euphoria)) AS params
					FROM ak_products AS pr
					LEFT JOIN ak_attribute_product AS ap ON ap.product_id = pr.id
					WHERE pr.parent_id IS NULL
					GROUP BY pr.id
					ORDER BY params
					LIMIT 4', [
            'sId' => self::ATTR_IDS['stimulation'],
            'rId' => self::ATTR_IDS['relaxation'],
            'eId' => self::ATTR_IDS['euphoria'],
            'stimulation' => $params['stimulation'],
            'relaxation' => $params['relaxation'],
            'euphoria' => $params['euphoria']
          ]);
		
		$related = Arr::pluck($related_array, 'id');
	  $related_unsorted = Product::whereIn('id', $related)->get()->keyBy('id');
	  
		foreach($related as $key => $id){
			$related[$key] = $related_unsorted[$id];
		}
					
		return $related;
	}

  public function updateQualities(Request $request, $id) {
    $data = $request->only(['stimulation', 'relaxation', 'euphoria']);

    if(empty($data))
      return throw new \Exception('No parameter in request.');

    try{
      $product = Product::findOrFail($id);
    }catch(ModelNotFoundException $e) {
      return response()->json($e->getMessage(), 404);
    }

    foreach($data as $key => $value) {
      $attr_id = self::ATTR_IDS[$key];
      $attr = $product->attrs()->find($attr_id);
      $attr_value = $attr->pivot->value + $value;

      if($attr_value >= 0 && $attr_value <= 100) {
        $product->attrs()->updateExistingPivot($attr_id, ['value' => $attr_value], false);
      }
    }

    return true;
  }
}
