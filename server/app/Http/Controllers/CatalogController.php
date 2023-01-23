<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Product;
use Aimix\Shop\app\Models\Attribute;
use Aimix\Shop\app\Models\Modification;
use Aimix\Shop\app\Models\Payment;
use Aimix\Shop\app\Models\Delivery;

use Illuminate\Support\Facades\DB;
use Aimix\Shop\app\Http\Controllers\CatalogController as PackageCatalogController;

class CatalogController extends PackageCatalogController
{
	
	
	public function calcRequest(Request $request){
		
		$params = [$request->input('stimulation'), $request->input('relaxation'), $request->input('euphoria')];
		
		$params = array_map(function($param){
			return $param * 20;
		}, $params);
		
		$products = $this->relatedItems($params, 99999999);
		
		return response()->json($products);			
	}
	
	
    public function show(Request $request) {
	    
	    $locales = array_keys(config('backpack.crud.locales'));
	    
	    $locales = array_map(function($item){
		    return strtolower(str_replace('_', '-', $item)).'/';
	    }, $locales);
	    
	    $slug = str_replace($locales, '', $request->path());
// 	    $slug = $request->path();

	    $product = Product::where('slug', $slug)->active()->first();
	    
	    // Add To Recently
	    if($product)
	    	self::addToRecently($request, $product->id);
	    
		$reviews = $product->reviews()->where('is_moderated', 1)->where('parent_id', 0)->orderBy('created_at', 'desc')->paginate(2);
	  
	  //get related products 
	  $attribute_params = $product->baseModification->attrs()->where('si', '%')->get();
	  $params = $attribute_params->pluck('pivot.value');
	  	  	  
	  $related_array = DB::select('
					select pr.id, 
							(ABS(MAX(IF(am.attribute_id = 2, am.value, 0)) - :stimulation) +
							 ABS(MAX(IF(am.attribute_id = 3, am.value, 0)) - :relaxation) +
							 ABS(MAX(IF(am.attribute_id = 4, am.value, 0)) - :euphoria)) AS params
					FROM products AS pr 
					LEFT JOIN modifications AS md ON md.product_id = pr.id 
					LEFT JOIN attribute_modification AS am ON am.modification_id = md.id
					WHERE md.is_default = 1 AND am.attribute_id IN (2,3,4) AND pr.id != :productId
					GROUP BY pr.id
					ORDER BY params
					LIMIT 4', ['stimulation' => ($params[0] ?? 0), 'relaxation' => ($params[1] ?? 0), 'euphoria' => ($params[2] ?? 0), 'productId' => $product->id]);  	  

	  $related = Arr::pluck($related_array, 'id');
	  $related_unsorted = Product::whereIn('id', $related)->get()->keyBy('id');
	  
	  foreach($related as $key => $id){
		  $related[$key] = $related_unsorted[$id];
	  }
  	  
  	  //get recently viewed products
  	  $recently = session('recently');
  	  
  	  if($recently){
	  	  $recently_unsorted = Product::whereIn('id', $recently)->get()->keyBy('id');
		  
		  $recently = array_reverse($recently);
		  foreach($recently as $key => $id){
			  $recently[$key] = $recently_unsorted[$id];
		  }
  	  }	
  	  $payments = Payment::active()->orderBy('lft')->orderBy('created_at', 'desc')->get();
  	  $deliveries = Delivery::active()->orderBy('lft')->orderBy('created_at', 'desc')->get();
  	  
      return view('catalog.show')->with('product', $product)
      							->with('reviews', $reviews)
      							->with('related', $related)
      							->with('recently', $recently)
      							->with('payments', $payments)
      							->with('deliveries', $deliveries);
    }
	
	public static function addToRecently($request, $id){
	    if($request->session()->has('recently')){
	    	$session_recently = $request->session()->get('recently');
			
			$key = array_search($id, $session_recently);
			if($key !== false)
				unset($session_recently[$key]);
	    }
	    
	    $session_recently[] = $id;
	    
	    $request->session()->put('recently', array_slice($session_recently, -6));		
	}
	
    public function changeAttr(Request $request) {
      $product = Product::find($request->id);
      $attrId = $product->baseAttributes->where('name', ucfirst($request->attr))->first()->id;
      
      $product->baseModification->attrs()->updateExistingPivot($attrId, ['value' => $request->value], false);

      return response()->json(true);
    }
    
    private function relatedItems($params, $productId){
		$related_array = DB::select('
					select pr.id, 
							(ABS(MAX(IF(am.attribute_id = 2, am.value, 0)) - :stimulation) +
							 ABS(MAX(IF(am.attribute_id = 3, am.value, 0)) - :relaxation) +
							 ABS(MAX(IF(am.attribute_id = 4, am.value, 0)) - :euphoria)) AS params
					FROM products AS pr 
					LEFT JOIN modifications AS md ON md.product_id = pr.id 
					LEFT JOIN attribute_modification AS am ON am.modification_id = md.id
					WHERE md.is_default = 1 AND am.attribute_id IN (2,3,4) AND pr.id != :productId
					GROUP BY pr.id
					ORDER BY params
					LIMIT 4', ['stimulation' => $params[0], 'relaxation' => $params[1], 'euphoria' => $params[2], 'productId' => $productId]);
					
		$related = Arr::pluck($related_array, 'id');
	    $related_unsorted = Product::whereIn('id', $related)->get()->keyBy('id');
	  
		foreach($related as $key => $id){
			$related[$key] = $related_unsorted[$id];
		}
					
		return $related;
	}
	
}