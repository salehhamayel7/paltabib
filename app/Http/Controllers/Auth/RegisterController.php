<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Clinic;
use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/admin/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'gender' => 'required',
            'user_name' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'address' => 'required',
            'clinic_phone' => 'required',
            'clinic_address' => 'required',
            'clinic' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        $clinic = new Clinic;
        $clinic->name = $data['clinic'];
        $clinic->address = $data['clinic_address'];
        $clinic->phone = $data['clinic_phone'];
        $clinic->manager_id = $data['user_name'];
        $clinic->save();

        $user = new User;
        $user->name = $data['name'];
        $user->clinic_id = $clinic->id;
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->role  = $data['role'];
        $user->user_name = $data['user_name'];
        $user->gender = $data['gender'];
        $user->address = $data['address'];
        $user->phone = $data['phone'];
        $user->save();

        if($data['role'] == "Manager,Doctor"){
            $doctor = new Doctor;
            $doctor->major = $data['major'];
            $doctor->clinic_id = $clinic->id;
            $doctor->user_name = $data['user_name'];
            $doctor->union_number = $data['union_number'];
            $doctor->save();

        }
        // $user->image = $data['user_name'].'_'.$data['image'];
        dd($user);
        
        return $user;
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
            'user_name'=> $data['user_name'],
            'image' => $data['image'],
            'gender'=> $data['gender'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            

        ]);
       */
        
    }
}
