<?php 

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Auth;
use App\Clinic;
use App\Doctor;
use App\User;

class ManagerService{

    
    public function changePic(Request $request)
	{
        if($request->hasFile('photo')){
               $image = $request->file('photo');
               $imageName = $request->user_name.'.'.$image->getClientOriginalExtension();
               Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
               DB::table('users')
                    ->where('user_name', '=' ,$request->user_name)
                    ->update(['image' => $imageName]);
            }
            return redirect()->back();

    }

     public function updateClinic(Request $request)
	{
        $clinic =  DB::table('clinics')
        ->where('id', '=' , Auth::user()->clinic_id)
        ->update([
            'name' => $request->clinic_name,
            'address' => $request->clinic_address,
            'phone' => $request->clinic_phone,
        ]);

    }

    

   public function editManager(Request $request)
	{


        DB::table('clinics')
            ->where('id', Auth::user()->clinic_id)
            ->update([
                'manager_id' => $request->ADuName,
        ]);

        

        if($request->hasFile('ATimage')){
            $image = $request->file('ATimage');
            $imageName = $request->ADuName.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
            DB::table('users')
                ->where('user_name', $request->originalUN)
                ->update([
                    'image' => $imageName,
            ]);
        }

        if(request()->has('ADpass')){
            DB::table('users')
            ->where('user_name', $request->originalUN)
            ->update([
                'password' => bcrypt($request->ADpass),
            ]);
        }

        DB::table('users')
            ->where('user_name', $request->originalUN)
            ->update([
                'name' => $request->ADName,
                'address' => $request->ADaddress,
                'phone' => $request->ADphone,
                'gender' => $request->ADgender,
                'user_name' => $request->ADuName,
                'email' => $request->ADemail,
        ]);

        if($request->role == "Manager,Doctor"){

            DB::table('doctors')
            ->where('user_name', $request->originalUN)
            ->update([
                'major' =>$request->ADmajor,
                'salary' =>$request->ADsalary,
                'user_name' =>$request->ADuName,
                'union_number' =>$request->ADunionNUM,
            ]);
    
        }
   

        return redirect()->back();
	}


    
}