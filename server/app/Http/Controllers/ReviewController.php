<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aimix\Review\app\Models\Review;
use Aimix\Review\app\Http\Requests\ReviewRequest;

use Aimix\Account\app\Models\Transaction;


use Aimix\Review\app\Http\Controllers\ReviewController as PackageReviewController;

class ReviewController extends PackageReviewController
{
	
    public function create(ReviewRequest $request, $type = 'text') 
    {
	    //$user = \Auth::user();
	    $user = $request->user();
	    
      $review = new Review;
      $review->type = $type;
      $review->name = $request->input($type . '_review_name');
      $review->email = $request->input($type . '_review_email');
      $review->text = $request->input($type . '_review_text');
      
      if(config('aimix.review.enable_review_for_product'))
        $review->product_id = $request->input($type . '_review_product_id');
        
      if(config('aimix.review.enable_rating'))
        $review->rating = $request->input($type . '_review_rating');
      
        
/*
      if($request->file($type . '_review_file')) {
        $path = $request->file($type . '_review_file')->store('reviews', 'reviews');
        
        $review->file = '/uploads/' . $path;
      }
*/

      
     
        $review->file = $user && $user->usermeta? $user->usermeta->photo: null;
		$review->user_id = $user? $user->id: 1;
        
      $review->save();

	   if($user)
	   		$this->createReviewBonusTransaction($review);
      
      return back()->with('message', __('main.review_success'))->with('type', 'review');
    }
    
    public function createReviewBonusTransaction($review) {
      $bonus = $review->name == 'Incognito'? 1 : 2;

      $transaction = new Transaction;
      $transaction->type = 'review';
      $transaction->description = '$' . $bonus . ' bonus for your review';
      $transaction->review_id = $review->id;
      $transaction->usermeta_id = \Auth::user()->usermeta->id;
      $transaction->change = $bonus;
      $transaction->is_completed = 0;
      $transaction->save();
    }
    
    public function loadmore(Request $request){
	    $product_id = $request->input('product_id');
	    
	    if($product_id)
	    	$reviews = Review::where('product_id', $product_id)->where('is_moderated', 1)->whereNull('parent_id')->orderBy('created_at', 'desc')->paginate(config('aimix.review.per_page'));
	    else
	    	$reviews = Review::where('is_moderated', 1)->where('parent_id', 0)->where('product_id', null)->orderBy('created_at', 'desc')->paginate(config('aimix.review.per_page'));
	    
	    return response()->json($reviews);
    }
    
    public function like(Request $request, $id){
	    $review = Review::find($id);
	    
	    if(isset($request->like))
	    	$review->likes = $review->likes + $request->like;

	    if(isset($request->dislike))
	    	$review->dislikes = $review->dislikes + $request->dislike;	    	
	    	
		$review->save();
    }
    
    public function reply(Request $request){
	    $user = \Auth::user();
	    
		$review = Review::create([
			'is_moderated' => 1,
			'parent_id' => $request->input('parent_id'),
			'product_id' => $request->input('product_id'),
			'text' => $request->input('text'),
			'type' => 'text',
			'name' => $request->user()->usermeta->fullname,
			'file' => $user && $user->usermeta? $user->usermeta->photo: null,
			'user_id' => $user? $user->id: null
		]);
		
		return response()->json(true);
	}

    public function add(Request $request){
	    $user = \Auth::user();
	    
		$review = Review::create([
			'parent_id' => $request->input('parent_id')? $request->input('parent_id'): 0,
			'product_id' => $request->input('product_id'),
			'text' => $request->input('text'),
			'type' => 'text',
			'name' => $request->input('name'),
			'file' => $user && $user->usermeta? $user->usermeta->photo: null,
			'user_id' => $user? $user->id: null
		]);
		
		
		if($user)
		$this->createReviewBonusTransaction($review);
		
		return response()->json(['message' => __('main.review_success')]);
	}
		
}
