<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;


use \App\Models\Override\Review;
use \App\Observers\ReviewObserver;

use \App\Models\Override\Order;
use \App\Observers\OrderObserver;

use \App\Models\Override\Profile;
use \App\Observers\ProfileObserver;

use \Backpack\Transactions\app\Models\Transaction;
use \App\Observers\TransactionObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    // protected $listen = [
    //     Registered::class => [
    //         SendEmailVerificationNotification::class,
    //     ],
    // ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
      Review::observe(ReviewObserver::class);
      Order::observe(OrderObserver::class);
      Profile::observe(ProfileObserver::class);
      Transaction::observe(TransactionObserver::class);
    }
}
