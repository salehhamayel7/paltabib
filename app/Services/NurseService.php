<?php 

namespace App\Services;

use App\Nurse;
use App\User;
use Image;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NurseService{


	public function createNurse(Request $request)
	{
		$nurse = new Nurse;
        $nurse->user_name = $request->ADuName;
        $nurse->salary = $request->ADsalary;
        $nurse->save();

        $user = new User;
        $user->user_name = $request->ADuName;
        $user->name = $request->ADName;
        $user->email = $request->ADemail;
        $user->gender = $request->ADgender;
        $user->password = $request->ADpass;
        $user->role = 'Nurse';
        $user->phone = $request->ADphone;
        $user->address = $request->ADaddress;
        $user->clinic_id = Auth::user()->clinic_id;


        if($request->hasFile('ATimage')){
            $image = $request->file('ATimage');
            $imageName = $user->user_name.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
            $user->image = $imageName;
        }

        $user->save();

	}

	public function getNurseWithUsername($user_name)
	{
		$nurse = Nurse::where('user_name','=',$user_name)->first();
        $user = User::where('user_name','=',$user_name)->first();
        $data =[
            'nurse' => $nurse,
            'user' => $user,
        ];
        return $data;
	}


public function deleteNurseWithUsername($user_name)
	{
		$nurse = Nurse::where('user_name','=',$user_name)->first();
        $nurse->delete();
        $user = User::where('user_name','=',$user_name)->first();
        $user->delete();
        
	}

	public function updateNurseWithUsername(Request $request,$user_name)
	{

            if(Auth::user()->role == 'Manager' || Auth::user()->role == 'Manager,Doctor' ){
                DB::table('nurses')
                    ->where('user_name', $user_name)
                    ->update(['salary' => $request->get('ADsalary')]);
            }

		 if(request()->has('ADpass')){
                DB::table('users')
                    ->where('user_name', $user_name)
                    ->update(['password' => bcrypt($request->get('ADpass'))]);
            }


                
            if($request->hasFile('ATimage')){
                $image = $request->file('ATimage');
                $imageName = $request->ADuName.'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
                DB::table('users')
                    ->where('user_name', $user_name)
                    ->update(['image' => $imageName]);
            }

            DB::table('users')
            ->where('user_name', $user_name)
            ->update([
                'name' => $request->ADName,
                'email' => $request->ADemail,
                'gender' => $request->ADgender,
                'phone' => $request->ADphone,
                'address' => $request->ADaddress,
                'user_name' => $request->ADuName
            ]);

            DB::table('nurses')
            ->where('user_name', $user_name)
            ->update([
                'user_name' => $request->ADuName
            ]);

        return redirect()->back();
	}
}