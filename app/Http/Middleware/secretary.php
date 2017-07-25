<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class secretary
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
        if(Auth::user()->role == "Secretary"){
            return $next($request);
        }
            return redirect('/');
    }
}
