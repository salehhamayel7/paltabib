<?php 

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Auth;

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


		 if(request()->has('ADpass')){
                DB::table('users')
                    ->where('user_name','=', $request->originalUN)
                    ->update(['password' => bcrypt($request->ADpass)]);
            }


            if($request->hasFile('ATimage')){
               $image = $request->file('ATimage');
               $imageName = $request->ADuName.'.'.$image->getClientOriginalExtension();
               Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
               DB::table('users')
                    ->where('user_name', '=' ,$request->originalUN)
                    ->update(['image' => $imageName]);
            }


		DB::table('users')
            ->where('user_name', $request->originalUN)
            ->update([
                'name' => $request->ADName,
                'email' => $request->ADemail,
                'gender' => $request->ADgender,
                'phone' => $request->ADphone,
                'address' => $request->ADaddress,
                'user_name' => $request->ADuName,

            ]);

            if($request->role == "Manager,Doctor"){
                DB::table('doctors')
                    ->where('user_name', $request->originalUN)
                    ->update([
                        'salary' => $request->ADsalary,
                        'major' => $request->ADmajor,
                        'union_number' => $request->ADunionNUM,
                        'user_name' => $request->ADuName,
                    ]);
            }


            return redirect()->back();
	}


}