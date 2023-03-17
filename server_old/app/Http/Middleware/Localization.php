<?php

namespace App\Http\Middleware;
use App;
use Closure;
use App\Http\Middleware\Session;
use Request;

use \Backpack\LangFileManager\app\Models\Language;

use Config;

class Localization
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
	    if($request->method() == 'POST'){
	    	return $next($request);
		}
		
	    $current = $request->path();
	    $segment_one = $request->segment(1);
	    $segment_one_language = explode('-', $segment_one)[0];
	    
	    $languages = array_keys(config('backpack.crud.locales'));
	    $languages = array_map(function($item){
		   return str_replace('_', '-', strtolower($item)); 
	    }, $languages);
	    
		$locale = \Session::has('lang')? \Session::get('lang'): (\App::getLocale()? \App::getLocale(): 'en-us');
		
		if(in_array($segment_one, $languages)){
			\Session::put('lang', $segment_one);
			\Session::put('url_lang', $segment_one);
			\App::setLocale($segment_one_language);
		}else{
			if($locale != 'en_US')
				return redirect('/' . $locale . $request->getRequestUri());
		}
				
		return $next($request);
        
    }


}