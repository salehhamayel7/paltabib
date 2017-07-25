<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class doctor
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
        if(Auth::user()->role == "Doctor"){
            return $next($request);
        }
            return redirect('/');
    }
}
