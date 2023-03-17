<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Backpack\MenuCRUD\app\Models\MenuItem;
use Illuminate\Database\Eloquent\Builder;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
	    if(!\Session::has('lang'))
	    	\Session::put('lang', 'en-us');
	    
	    if(!\Session::has('url_lang'))
	    	\Session::put('url_lang', '');	
            
	    View::composer('backpack::inc.topbar_left_content', function ($view) {
		    $orders = \Aimix\Shop\app\Models\Order::where('status','new')->count();
		    $reviews = \Aimix\Review\app\Models\Review::where('is_moderated', 0)->get()->count();
		    $feedback = \Aimix\Feedback\app\Models\Feedback::all()->count();
		    
			$view->with('orders', $orders)->with('reviews', $reviews)->with('feedback', $feedback);
		});
	    
	    View::composer('backpack::inc.sidebar_content', function ($view) {
		    $transactions = \Aimix\Account\app\Models\Transaction::where('is_completed', 0)->get()->count();
		    $view->with('transactions', $transactions);
		});
	    
        View::composer('*', function ($view) {
          $menu = MenuItem::where('parent_id', 1)->orderBy('lft')->get();
          $sub_menu = MenuItem::where('parent_id', 11)->orderBy('lft')->get();
          $user = \Auth::user();
              
          $view->with('menu', $menu)->with('sub_menu', $sub_menu)->with('user', $user);
        });
    }
}
