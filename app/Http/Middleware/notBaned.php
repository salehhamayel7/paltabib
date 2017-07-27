<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;

class notBaned
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
        $clinic = DB::table('clinics')
            ->where('id', Auth::user()->clinic_id)
            ->first();

        if($clinic->banned == 0){
            return $next($request);
        }
            return redirect('/');
    }
}
