<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $redirectTo = "";
        if(Auth::user()->role == "Admin"){
            $redirectTo = '/dashboard/admin';
        }
        else if(Auth::user()->role == "Manager" || Auth::user()->role == "Manager,Doctor"){
            $redirectTo = '/dashboard/manager';
          
        }
        else if(Auth::user()->role == "Doctor"){
            $redirectTo = '/dashboard/doctor';
           
        }
        else if(Auth::user()->role == "Secretary"){
            $redirectTo = '/dashboard/secretary';
           
        }
        else if(Auth::user()->role == "Pacient"){
            $redirectTo = '/dashboard/pacient';
        }
         return redirect($redirectTo);
    }
    
    public function showAdmin()
    {
 
        $user = Auth::user();
        
        return view('admin_dashboard' , compact('user','doctors','clinic','new_msgs'));
    
    }
    
    
}
