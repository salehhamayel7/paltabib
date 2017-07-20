<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Image;

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
        
        return view('admin_dashboard' , compact('user'));
    
    }

    public function AddClinicPage()
    {
 
        $user = Auth::user();
        
        return view('clinicFormReg' , compact('user'));
    
    }

    public function allCinics()
    {
 
        $user = Auth::user();
        $clinics =  DB::table('clinics')
            ->where('clinics.id','>',0)
            ->join('users', 'clinics.manager_id', '=', 'users.user_name')
            ->select('clinics.address as clinic_address' , 'clinics.id as clinic_id' , 'clinics.name as clinic_name' , 'clinics.phone as clinic_phone', 'clinics.*', 'users.*')
            ->get();
        return view('admin_allCinics' , compact('user','clinics'));
    
    }

    public function showHomeConfig()
    {
 
        $user = Auth::user();
        $sliders =  DB::table('sliders')->orderBy('updated_at', 'desc')->paginate(3, ['*'], 'sliders');
        return view('HomePageConfig' , compact('user','sliders'));
    
    }

    public function addSlider(Request $request)
    {   
        $current_time = Carbon::now()->toDateTimeString();

        $image = $request->file('image');
        $imageName = str_random(10).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save(public_path("images\\slider\\". $imageName));
        
 
        DB::table('sliders')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => "/images/slider/".$imageName,
            'updated_at' => $current_time
        ]);
        
        return redirect()->back();
    
    }


    public function getSlide($id)
    {
        $slide = DB::table('sliders')->where('id','=',$id)->first();
        $data =[
            'slide' => $slide,
        ];
        return $data;
    }

    public function deleteSlide($id)
    {
        $slide = DB::table('sliders')->where('id','=',$id)->delete();
       
    }

    public function updateSlide(Request $request)
    {
        $id=$request->id;
        if($request->hasFile('image')){
               $image = $request->file('image');
               $imageName = str_random(10).'.'.$image->getClientOriginalExtension();
               Image::make($image)->resize(300,300)->save(public_path("images\\slider\\". $imageName));
               DB::table('sliders')
                    ->where('id','=',$id)
                    ->update(['image' => $imageName]);
            }

        $slide = DB::table('sliders')->where('id','=',$id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                ]);

                 return redirect()->back();
       
    }

    

}
