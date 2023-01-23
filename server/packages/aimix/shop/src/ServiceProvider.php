<?php

namespace Aimix\Shop;

use Aimix\Shop\app\Observers\ProductObserver;
use Aimix\Shop\app\Observers\ModificationObserver;
use Aimix\Shop\app\Observers\OrderObserver;

use App\Models\Modification;
use Aimix\Shop\app\Models\Product;
use Aimix\Shop\app\Models\Order;
use Illuminate\Support\Facades\View;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/shop.php';

    public function boot()
    {
      // dd(session()->all());
      Product::observe(ProductObserver::class);
      Modification::observe(ModificationObserver::class);
      Order::observe(OrderObserver::class);
      
      $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'shop');
    
	    // Migrations
	    $this->loadMigrationsFrom(__DIR__.'/database/migrations');
	    
	    // Routes
    	$this->loadRoutesFrom(__DIR__.'/routes/backpack/routes.php');
    
		  // Config

      $this->publishes([
          self::CONFIG_PATH => config_path('aimix/shop.php'),
      ], 'config');
      
      // $this->loadViewsFrom(__DIR__.'/resources/views', 'shop');
      
      $this->publishes([
        __DIR__.'/resources/views' => resource_path('views'),
      ]);
      
      // $this->publishes([
      //     __DIR__.'/path/to/assets' => public_path('packages/aimix/shop/public/js'),
      // ], 'public');
      
      View::composer('*', function ($view) {
        // $language = session()->has('lang')? session()->get('lang'): 'ru';
        // \App::setLocale($language);
// dd(session()->get('lang'));
        $cart = session()->has('cart')? session()->get('cart'): [];
        
        // $view->with('cart', $cart)->with('lang', $language);
        // session()->put('lol', 'asd');
        // dd(session()->all());
        $view->with('cart', $cart);
      });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'shop'
        );

        $this->app->bind('shop', function () {
            return new Shop();
        });
    }
}
