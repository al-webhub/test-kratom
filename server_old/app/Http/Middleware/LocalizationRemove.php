<?php

namespace App\Http\Middleware;
use App;
use Closure;
use App\Http\Middleware\Session;
use Request;

class LocalizationRemove
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
	    \Session::put('url_lang', '');
	    \Session::put('lang', 'en-us');			
		return $next($request);
    }


}