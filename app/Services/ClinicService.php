<?php 

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Clinic;
use App\User;
use App\Doctor;
use Helper;
use Image;
use Storage;
use File;

class ClinicService{

    public function deleteClinic($id)
    {
      
        $clinic = DB::table('clinics')->where('id', $id)->first();
        DB::table('users')->where('user_name', $clinic->manager_id)->delete();
        DB::table('clinics')->where('id', $id)->delete();
    }

    

    public function registerClinic(Request $request)
	{
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role  = $request->role;
        $user->user_name = $request->user_name;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->phone = $request->phone;

        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = str_random(50).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
            $user->image =  $imageName;
        }

        if($file = $request->file('id_image'))
        {
            $filename= str_random(50).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put($filename,File::get($file));
            $user->id_image =  $filename;
        }

        $user->save();

        $id= Helper::getGreatestIDfrom('clinics');
        $clinic = new Clinic;
        $clinic->id = $id+1;
        $clinic->name = $request->clinic;
        $clinic->address = $request->clinic_address;
        $clinic->phone = $request->clinic_phone;
        $clinic->manager_id = $request->user_name;

        
        if($file = $request->file('reg_proof'))
        {
            $filename= str_random(50).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put($filename,File::get($file));
            $clinic->reg_proof =  $filename;
        }

        $clinic->save();

        $user->clinic_id = $clinic->id;
        $user->save();

        if($request->role == "Manager,Doctor"){
            $doctor = new Doctor;
            $doctor->id = $user->id;
            $doctor->major = $request->major;
            $doctor->clinic_id =$clinic->id;
            $doctor->user_name = $request->user_name;
            $doctor->union_number = $request->union_number;
            $doctor->save();

        }

        DB::table('receipts')->insert([
			'clinic_id' => $clinic->id,
		]);
    }

    public function updateClinic(Request $request)
	{   
        $userx = User::where('user_name', $request->old_user_name)->first();
        $clinicx = Clinic::where('id', $request->clinic_id)->first();

        DB::table('clinics')
            ->where('id', $request->clinic_id)
            ->update([
                'manager_id' => $request->user_name,
                'name' => $request->clinic,
                'address' => $request->clinic_address,
                'phone' => $request->clinic_phone,
            ]);


        if($file = $request->file('reg_proof'))
        {
            Storage::delete($clinicx->reg_proof);

            $filename= str_random(50).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put($filename,File::get($file));
            DB::table('clinics')
            ->where('id', $request->clinic_id)
            ->update([
                'reg_proof' => $filename,
            ]);
        }


        if($request->hasFile('image')){

            if($userx->image != "User_Avatar-512.png"){
                $file_path = public_path().'\\images\\users\\'.$userx->image;
                unlink($file_path);
            }

            $image = $request->file('image');
            $imageName = str_random(50).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
            DB::table('users')
            ->where('user_name', $request->old_user_name)
            ->update([
                'image' => $imageName,
            ]);
        }


        if($file = $request->file('id_image'))
        {
            Storage::delete($userx->id_image);

            $filename= str_random(50).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put($filename,File::get($file));
            DB::table('users')
                ->where('user_name', $request->old_user_name)
                ->update([
                    'id_image' => $filename,
                ]);
        }

        if(request()->has('password')){
            DB::table('users')
            ->where('user_name', $request->old_user_name)
            ->update([
                'password' => bcrypt($request->password),
            ]);
        }

        DB::table('users')
            ->where('user_name', $request->old_user_name)
            ->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'user_name' => $request->user_name,
                'email' => $request->email,
            ]);

        if($request->role == "Manager,Doctor"){

            DB::table('doctors')
            ->where('user_name', $request->old_user_name)
            ->update([
                'major' =>$request->major,
                'user_name' =>$request->user_name,
                'union_number' =>$request->union_number,
            ]);
    
        }
       
    }

    
    public function banOrNotClinic($id)
    {
        $clinic = DB::table('clinics')
            ->where('id', $id)
            ->first();
        $x = 0;
        if($clinic->banned == 1){
            $x = 0;
        }
        else{
            $x = 1;
        }

        DB::table('clinics')
            ->where('id', $id)
            ->update(['banned'=> $x]);
        return $x;
    }
    
    public function getClinic($id)
    {
      
    $clinic = DB::table('clinics')
        ->where('id', $id)
        ->first();
    $user = DB::table('users')
        ->where('user_name', $clinic->manager_id)
        ->first();

    $doctor = DB::table('doctors')
        ->where('user_name', $clinic->manager_id)
        ->first();

		$data =[
            'clinic' => $clinic,
            'user' => $user,
            'doctor' => $doctor,
        ];

        return $data;

    }
    

}