<?php 

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Auth;
use App\Clinic;
use App\Doctor;
use App\User;
use Storage;
use File;

class ManagerService{

    
    public function changePic(Request $request)
	{
        $userx = User::where('user_name', $request->user_name)->first();

        if($request->hasFile('photo')){

            if($userx->image != "User_Avatar-512.png"){
                $file_path = public_path().'\\images\\users\\'.$userx->image;
                unlink($file_path);
            }
            $image = $request->file('photo');
            $imageName =  str_random(50).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
            DB::table('users')
                ->where('user_name', '=' ,$request->user_name)
                ->update(['image' => $imageName]);
        }
        return redirect()->back();

    }

     public function updateClinic(Request $request)
	{
        $clinicx = Clinic::where('id', Auth::user()->clinic_id)->first();

        if($file = $request->file('reg_proof'))
        {
            Storage::delete($clinicx->reg_proof);
            $filename= str_random(50).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put($filename,File::get($file));
            DB::table('clinics')
            ->where('id', Auth::user()->clinic_id)
            ->update([
                'reg_proof' => $filename,
            ]);
        }

        if($request->hasFile('logo')){
            if($clinicx->logo != "defult-logo.png"){
                $file_path = public_path().'\\images\\clinics_logos\\'.$clinicx->logo;
                unlink($file_path);
            }
            $image = $request->file('logo');
            $imageName = str_random(50).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\clinics_logos\\". $imageName));
            DB::table('clinics')
            ->where('id', '=' , Auth::user()->clinic_id)
            ->update([
                'logo' => $imageName,
            ]);
        }

        DB::table('clinics')
        ->where('id', '=' , Auth::user()->clinic_id)
        ->update([
            'name' => $request->clinic_name,
            'address' => $request->clinic_address,
            'phone' => $request->clinic_phone,
        ]);

    }

    

   public function editManager(Request $request)
	{
        $userx = User::where('user_name', $request->originalUN)->first();
        

        DB::table('clinics')
            ->where('id', Auth::user()->clinic_id)
            ->update([
                'manager_id' => $request->ADuName,
        ]);

        if($file = $request->file('id_image'))
        {
            Storage::delete($userx->id_image);

            $filename= str_random(50).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put($filename,File::get($file));
            DB::table('users')
                ->where('user_name', $request->originalUN)
                ->update([
                    'id_image' => $filename,
                ]);
        }

        if($request->hasFile('ATimage')){
            if($userx->image != "User_Avatar-512.png"){
                $file_path = public_path().'\\images\\users\\'.$userx->image;
                unlink($file_path);
            }
            $image = $request->file('ATimage');
            $imageName = str_random(50).'.'.$image->getClientOriginalExtension();
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