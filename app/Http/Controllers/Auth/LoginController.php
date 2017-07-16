<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     
    protected $redirectTo;

    protected function redirectTo()
    {
        if(Auth::user()->role == "Admin"){
            $this->redirectTo = '/dashboard/admin';
            return $this->redirectTo;
        }
        else if(Auth::user()->role == "Manager" || Auth::user()->role == "Manager,Doctor"){
            $this->redirectTo = '/dashboard/manager';
            return $this->redirectTo;
        }
        else if(Auth::user()->role == "Doctor"){
            $this->redirectTo = '/dashboard/doctor';
            return $this->redirectTo;
        }
        else if(Auth::user()->role == "Secretary"){
            $this->redirectTo = '/dashboard/secretary';
            return $this->redirectTo;
        }
        else if(Auth::user()->role == "Pacient"){
            $this->redirectTo = '/dashboard/pacient';
            return $this->redirectTo;
        }
    }
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}
