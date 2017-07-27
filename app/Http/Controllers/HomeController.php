<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Image;
use Storage;
use Illuminate\Http\Response;

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
        $clinics = DB::table('clinics')->get();
        $users = DB::table('users')->whereNotIn('user_name', [Auth::user()->user_name])->get();
        $doctors = DB::table('doctors')->get();
        $patients = DB::table('pacients')->get();
        $nurses = DB::table('nurses')->get();
        $appointments = DB::table('appointments')->get();

        $clinics_count = count($clinics);
        $users_count = count($users);
        $doctors_count = count($doctors);
        $patients_count = count($patients);
        $nurses_count = count($nurses);
        $appointments_count = count($appointments);

        /*$dt = Carbon::now();
        $dt->setTimezone('Asia/Jerusalem');

        $startofweek = $dt->startOfWeek();
        $dt = Carbon::now();
        $dt->setTimezone('Asia/Jerusalem');
        
        $startoflastweek = $startofweek->subDays(7);
        $dt = Carbon::now();
        $dt->setTimezone('Asia/Jerusalem');

        $lastweekusers = DB::table('users')
            ->where([
                ['created_at', '>', $startoflastweek->toDateTimeString()],
                ['created_at', '<=', $startofweek->toDateTimeString()],
            ])->whereNotIn('user_name', [Auth::user()->user_name])->get();
        
        $thisweekusers = DB::table('users')
            ->where([
                ['created_at', '>', $startofweek->toDateTimeString()],
                ['created_at', '<=', $dt->toDateTimeString()],
            ])->whereNotIn('user_name', [Auth::user()->user_name])->get();


        $thisweekusersnum = count($lastweekusers);
        if($thisweekusersnum == 0 ){
            $thisweekusersnum++;
        }

        $per = ((count($thisweekusers) - count($lastweekusers))/$thisweekusersnum)*100;

        dd($per);*/

        return view('admin/admin_dashboard' , compact('user','clinics_count','users_count','doctors_count','patients_count','nurses_count','appointments_count'));
    
    }

    

    public function downloadFile($name) {

        $file = Storage::disk('local')->get($name);
        
        return (new Response($file, 200))
              ->header('Content-Type', "asdas");
    }

    public function AddClinicPage()
    {
 
        $user = Auth::user();
        
        return view('admin/clinicFormReg' , compact('user'));
    
    }

    public function allCinics()
    {
 
        $user = Auth::user();
        $clinics =  DB::table('clinics')
            ->where('clinics.id','>',0)
            ->join('users', 'clinics.manager_id', '=', 'users.user_name')
            ->select('clinics.address as clinic_address' , 'clinics.id as clinic_id' , 'clinics.name as clinic_name' , 'clinics.phone as clinic_phone', 'clinics.*', 'users.*')
            ->get();
        return view('admin/admin_allCinics' , compact('user','clinics'));
    
    }

    public function showHomeConfig()
    {
 
        $user = Auth::user();
        $sliders =  DB::table('sliders')->orderBy('updated_at', 'desc')->paginate(3, ['*'], 'sliders');
        $sections =  DB::table('sections')->orderBy('updated_at', 'desc')->paginate(3, ['*'], 'sections');        
        return view('admin/HomePageConfig' , compact('user','sliders','sections'));
    
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

    public function addSection(Request $request)
    {   
        $current_time = Carbon::now()->toDateTimeString();

        $image = $request->file('image');
        $imageName = str_random(10).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save(public_path("images\\sections\\". $imageName));
        
 
        DB::table('sections')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => "/images/sections/".$imageName,
            'updated_at' => $current_time
        ]);
        
        return redirect()->back();
    
    }

    
    public function showSlide($id)
    {
      
        $dt = Carbon::now()->toDateTimeString();
        $slide = DB::table('sliders')->where('id','=',$id)->update(['updated_at' => $dt]);;

    }


    public function showSection($id)
    {
      
        $dt = Carbon::now()->toDateTimeString();
        $slide = DB::table('sections')->where('id','=',$id)->update(['updated_at' => $dt]);;

    }

    public function getSlide($id)
    {
        $slide = DB::table('sliders')->where('id','=',$id)->first();
        $data =[
            'slide' => $slide,
        ];
        return $data;
    }

    public function getSection($id)
    {
        $slide = DB::table('sections')->where('id','=',$id)->first();
        $data =[
            'section' => $slide,
        ];
        return $data;
    }

    public function deleteSlide($id)
    {
        $slide = DB::table('sliders')->where('id','=',$id)->first();
        if (strpos($slide->image, 'http') == false) {
            $file_path = public_path().'\\images\\slider\\'.$slide->image;
            unlink($file_path);
            DB::table('sliders')->where('id','=',$id)->delete();
        }
    }

    public function deleteSection($id)
    {
        $section = DB::table('sections')->where('id','=',$id)->first();
        if (strpos($section->image, 'http') == false) {
                $file_path = public_path().'\\images\\sections\\'.$section->image;
                unlink($file_path); 
            DB::table('sections')->where('id','=',$id)->delete();
        }
              
    }

    public function updateSlide(Request $request)
    {
        $id=$request->id;

        $slidex = DB::table('sliders')->where('id','=',$id)->first();
        if($request->hasFile('image')){
            if (strpos($slidex->image, 'http') == false) {
                $file_path = public_path().'\\images\\slider\\'.$slidex->image;
                unlink($file_path);
            }
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

    public function updateSection(Request $request)
    {
        $id=$request->id;
        $sectionx = DB::table('sections')->where('id','=',$id)->first();
        if($request->hasFile('image')){
            if (strpos($sectionx->image, 'http') == false) {
                $file_path = public_path().'\\images\\sections\\'.$sectionx->image;
                unlink($file_path); 
            }
            $image = $request->file('image');
            $imageName = str_random(10).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\sections\\". $imageName));
            DB::table('sections')
                ->where('id','=',$id)
                ->update(['image' => $imageName]);
        }

        $slide = DB::table('sections')->where('id','=',$id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
        ]);

        return redirect()->back();
       
    }

}
