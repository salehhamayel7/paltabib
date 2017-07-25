<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class manager
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
        if(Auth::user()->role == "Manager" || Auth::user()->role == "Manager,Doctor"){
            return $next($request);
        }
            return redirect('/');
    }
}
