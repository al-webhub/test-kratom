<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthenticateProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'profile')
    {
        if(!auth()->guard($guard)->check()) {
            return response()->json('Not Authenticated', 403);
        }

        return $next($request);

    }
}