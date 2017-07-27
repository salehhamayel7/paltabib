<?php 

namespace App\Services;

use App\Pacient;
use App\User;
use Image;
use Auth;
use App\Appointment;
use Illuminate\Http\Request;
use File;
use Storage;
use Illuminate\Support\Facades\DB;

class PacientService{

    public function changePicture(Request $request)
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

	public function createPacient(Request $request)
	{
        $pacient = User::where('email',$request->ADuName)->first();
        if($pacient){
            $temp_patient = DB::table('patient_clinic')
                    ->where([
                        ['patient_id', '=', $pacient->user_name],
                        ['clinic_id', '=', Auth::user()->clinic_id],
                    ])->get();
            if(count($temp_patient) <= 0){
                DB::table('patient_clinic')->insert([
                   'clinic_id' => Auth::user()->clinic_id,
				   'patient_id' => $pacient->user_name,
                ]);
            }
            
        }
        else{

            $user = new User;

            $user->user_name = $request->ADuName;
            $user->name = $request->ADName;
            $user->email = $request->ADemail;
            $user->gender = $request->ADgender;
            $user->password = bcrypt($request->ADpass);
            $user->role = 'Pacient';
            $user->phone = $request->ADphone;
            $user->address = $request->ADaddress;


            if($request->hasFile('ATimage')){
                $image = $request->file('ATimage');
                $imageName =  str_random(50).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
                $user->image = $imageName;
            }

            if($file = $request->file('id_image'))
            {
                $filename= str_random(50).'.'.$file->getClientOriginalExtension();
                Storage::disk('local')->put($filename,File::get($file));
                $user->id_image = $filename;
            }
            
            $user->save();

            $pacient = new Pacient;
            $pacient->id = $user->id;
            $pacient->user_name = $request->ADuName;
            $pacient->ensurance_number = $request->ensurance;
            $pacient->job = $request->ADjob;
            $pacient->married  = $this->isTrue($request->married);
            $pacient->smoking  = $this->isTrue($request->smoker);
            $pacient->drugs    = $this->isTrue($request->sot); 
            $pacient->alcohol  = $this->isTrue($request->drunk);
            $pacient->allergic = $this->isTrue($request->touchy);
            $pacient->disability = $this->isTrue($request->disablity);
            $pacient->allergic_from = $request->allergic_from;
            $pacient->social_history = $request->sh;
            $pacient->family_history = $request->fh;
            $pacient->past_history= $request->ph;
            $pacient->demo_details= $request->dd;
            $pacient->systematic_en= $request->se;
            $pacient->cardio_system= $request->cvs;
            $pacient->respiratory_system= $request->rs;
            $pacient->on_exam= $request->oe;
            $pacient->present_comp= $request->pc;
            $pacient->history_of_comp= $request->hpc;
            $pacient->drug_history= $request->dh;
            $pacient->save(); 

            DB::table('patient_clinic')->insert([
                   'clinic_id' => Auth::user()->clinic_id,
				   'patient_id' => $user->user_name,
                ]);

        }
		
	}

	public function getPacientWithUsername($user_name)
	{
		$pacient = Pacient::where('user_name','=',$user_name)->first();
        $user = User::where('user_name','=',$user_name)->first();
        $data =[
            'pacient' => $pacient,
            'user' => $user,
        ];
        return $data;
	}


    public function deletePacientWithUsername($user_name)
	{
		$pacient = Pacient::where('user_name','=',$user_name)->first();
        $pacient->delete();
        $user = User::where('user_name','=',$user_name)->first();
        $user->delete();
        
	}

	public function updatePacientWithUsername(Request $request,$user_name)
	{
        $userx = User::where('user_name', $user_name)->first();

         DB::table('patient_clinic')
                    ->where('patient_id' , $user_name)
                    ->update(['patient_id' => $request->ADuName]);

		 if(request()->has('ADpass')){
                DB::table('users')
                    ->where('user_name', $user_name)
                    ->update(['password' => bcrypt($request->ADpass)]);
            }

        if($request->hasFile('ATimage')){
            if($userx->image != "User_Avatar-512.png"){
                $file_path = public_path().'\\images\\users\\'.$userx->image;
                unlink($file_path);
            }
            $image = $request->file('ATimage');
            $imageName =  str_random(50).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
            DB::table('users')
                    ->where('user_name', $user_name)
                    ->update(['image' => $imageName]);
        }

        if($file = $request->file('id_image'))
        {
            Storage::delete($userx->id_image);
            $filename= str_random(50).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put($filename,File::get($file));
            DB::table('users')
                ->where('user_name', $user_name)
                ->update([
                    'id_image' => $filename,
                ]);
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
            
             if(Auth::user()->role == 'Manager' || Auth::user()->role == 'Manager,Doctor' || Auth::user()->role == 'Doctor'){
                DB::table('pacients')
                ->where('user_name', $user_name)
                ->update([
                    'ensurance_number' => $request->ensurance,
                    'user_name' => $request->ADuName,
                    'job' => $request->ADjob,
                    'married' => $this->isTrue($request->married),
                    'smoking' => $this->isTrue($request->smoker),
                    'drugs' => $this->isTrue($request->sot),
                    'alcohol' => $this->isTrue($request->drunk),
                    'allergic' => $this->isTrue($request->touchy),
                    'disability' => $this->isTrue($request->disablity),
                    'allergic_from' => $request->allergic_from,
                    'social_history' => $request->sh,
                    'family_history' => $request->fh,
                    'past_history'=> $request->ph,
                    'demo_details'=> $request->dd,
                    'systematic_en'=> $request->se,
                    'cardio_system'=> $request->cvs,
                    'respiratory_system'=> $request->rs,
                    'on_exam'=> $request->oe,
                    'present_comp'=> $request->pc,
                    'history_of_comp'=> $request->hpc,
                    'drug_history'=> $request->dh,

                ]);
             }

              
        return redirect()->back();
	}

    public function bookAppointemnt(array $data)
    {
          Appointment::create([
             
             'doctor_id'   => $data['doctor_id'],
             'pacient_id'  => $data['pacient_id'],
             'date'        => $data['date'],
             'time'        => $data['time'] 

            ]);
    }

    function isTrue($status)
    {
      if($status == "on")
      {
        return 1;
      }
      return 0;
    }
}