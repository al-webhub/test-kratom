<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ProductController extends \App\Http\Controllers\Controller
{
    public function getByIds(Request $request){
	    
	    if(empty($request->ids))
	    	return response()->json(['products' => []]);
	    	
	    $products = \App\Models\Product::whereIn('id', $request->ids)->get();
	    
	    return response()->json($products); 
    }
}
