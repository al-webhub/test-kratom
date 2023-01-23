<?php

namespace App\Observers;

use \App\Models\Override\Review;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function created(Review $review)
    {
      $bonus = $review->method === 'incognito'? 1 : 2;

      $data = [
        'owner_id' => $review->owner_id,
        'value' => $bonus,
        'currency' => 'USD',
        'description' => '$' . $bonus . ' bonus for your review',
        'type' => 'review',
        'status' => 'complited',
      ];

      $review->createTransaction($data);
    }

    /**
     * Handle the Review "updated" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function updated(Review $review)
    {
        //
    }

    /**
     * Handle the Review "deleted" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        //
    }

    /**
     * Handle the Review "restored" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function restored(Review $review)
    {
        //
    }

    /**
     * Handle the Review "force deleted" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function forceDeleted(Review $review)
    {
        //
    }
}
