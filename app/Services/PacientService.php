<?php 

namespace App\Services;

use App\Pacient;
use App\User;
use Image;
use Auth;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PacientService{

    public function changePicture(Request $request)
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

	public function createPacient(Request $request)
	{   
        $pacient = Pacient::where('user_name',$request->ADuName)->first();
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

            $pacient = new Pacient;
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
                $imageName = $user->user_name.'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
                $user->image = $imageName;
            }

            DB::table('patient_clinic')->insert([
                   'clinic_id' => Auth::user()->clinic_id,
				   'patient_id' => $pacient->user_name,
                ]);
            $user->save();

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
		 if(request()->has('ADpass')){
                DB::table('users')
                    ->where('user_name', $user_name)
                    ->update(['password' => bcrypt($request->ADpass)]);
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
            
             if(Auth::user()->role == 'Manager' || Auth::user()->role == 'Manager,Doctor' ){
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