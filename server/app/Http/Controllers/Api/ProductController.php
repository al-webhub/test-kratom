<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

use \App\Models\Product;

class ProductController extends \App\Http\Controllers\Controller
{ 
  public function updateQualities(Request $request, $id) {
    $data = $request->only(['stimulation', 'relaxation', 'euphoria']);

    try{
      $product = Product::findOrFail($id);
    }catch(ModelNotFoundException $e) {
      return response()->json($e->getMessage(), 404);
    }

    $extras = $product->extras? $product->extras: [];
    
    foreach($data as $key => $item) {
      $old_value = isset($extras[$key])? $extras[$key]: 0;

      $clear_item = (int)$item;

      if(($clear_item === 1 && $old_value < 100) || ($clear_item === -1 && $old_value > 0))
        $extras[$key] = $old_value + $clear_item;
    }

    $product->extras = $extras;
    $product->save();

    return true;
  }
}
