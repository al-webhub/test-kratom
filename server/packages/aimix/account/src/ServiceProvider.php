<?php

namespace Aimix\Account;

use Illuminate\Support\Facades\View;

use Aimix\Account\app\Observers\UserObserver;
use Aimix\Account\app\Observers\TransactionObserver;
use Aimix\Account\app\Models\Usermeta;
use Aimix\Account\app\Models\Transaction;
use App\User;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/account.php';

    public function boot()
    {
        User::observe(UserObserver::class);
        Transaction::observe(TransactionObserver::class);

        $this->publishes([
            self::CONFIG_PATH => config_path('account.php'),
        ], 'config');

        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'shop');
    
	    // Migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        
        // Routes
        $this->loadRoutesFrom(__DIR__.'/routes/backpack/routes.php');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views'),
        ]);
        
        View::composer('*', function ($view) {
            $user = \Auth::user();
            $transaction = $user? $user->transactions()->where('is_completed', 1)->orderBy('created_at', 'desc')->first(): null;
            $balance = $transaction? $transaction->balance: 0;
            
            $referrer = Usermeta::where('referral_code', request()->get('ref'))->where('referral_code', '!=', null)->first();
            $ref_id = $referrer ? $referrer->id : null;
            session()->put('ref_id', $ref_id);

            $view->with('user', $user)->with('ref_id', $ref_id)->with('balance', $balance);
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'account'
        );

        $this->app->bind('account', function () {
            return new account();
        });
    }
}
