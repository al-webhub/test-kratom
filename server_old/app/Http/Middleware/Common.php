<?php

namespace App\Http\Middleware;
use App;
use Closure;
use App\Http\Middleware\Session;
use Request;

use \Backpack\LangFileManager\app\Models\Language;

use Config;

class Common
{
     /**
      * Handle an incoming request.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \Closure  $next
      * @return mixed
      */
    public function handle($request, Closure $next)
    {
	    \Artisan::call('config:clear');
    	$this->overrideConfigValues();
    	
		return $next($request);
    }

	private function overrideConfigValues()
	{
	    $settings = \App\Models\Setting::all();

        // bind all settings to the Laravel config, so you can call them like
        // Config::get('settings.contact_email')
        foreach ($settings as $key => $setting) {
            Config::set('settings.'.$setting->key, $setting->value);
        }
        
        //dd(config('settings'));
	}
}