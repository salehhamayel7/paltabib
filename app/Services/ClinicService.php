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
            $imageName = $request->user_name.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
            $user->image =  $imageName;
        }
        $user->save();

        $id= Helper::getGreatestIDfrom('clinics');
        $clinic = new Clinic;
        $clinic->id = $id+1;
        $clinic->name = $request->clinic;
        $clinic->address = $request->clinic_address;
        $clinic->phone = $request->clinic_phone;
        $clinic->manager_id = $request->user_name;
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
        

        DB::table('clinics')
            ->where('id', $request->clinic_id)
            ->update([
                'manager_id' => $request->user_name,
                'name' => $request->clinic,
                'address' => $request->clinic_address,
                'phone' => $request->clinic_phone,
            ]);

        

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $request->user_name.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
            DB::table('users')
            ->where('user_name', $request->old_user_name)
            ->update([
                'image' => $imageName,
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