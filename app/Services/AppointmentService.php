<?php 

namespace App\Services;

use App\Appointment;
use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;

class AppointmentService{

    public function deleteAppointment($id)
	{
         DB::table('appointments')->where('id','=',$id)->delete();
	}


     public function approveAppointment($id)
	{
         DB::table('appointments')->where('id','=',$id)
         ->update([
                'is_approved' => 1
            ]);
	}

    

    public function getPatietsAppointmens(){
        $user = Auth::user();
		$appointments = DB::table('appointments')
                ->where([
                    ['pacient_id', '=', $user->user_name],
                ])->get();
            
		$data =[
            'appointments' => $appointments,
        ];
        return $data;
	}

    public function getAllAppointments(){
        $user = Auth::user();
		$appointments = DB::table('appointments')
                ->where([
                    ['doctor_id', '=', $user->user_name],
                    ['is_approved', '=', '1'],
                ])->get();
            
		$data =[
            'appointments' => $appointments,
        ];
        return $data;
	}
    public function getAppointmentWithid($id){
        $appointment = DB::table('appointments')->where('id', '=', $id)->first();
        $doctor= DB::table('users')->where('user_name',$appointment->doctor_id)->first();
        $data =[
            'appointment' => $appointment,
            'doctor' => $doctor,
        ];
        return $data;
    }

    public function showDocAppointments($id){
        $appointments = DB::table('appointments')->where('doctor_id', '=', $id)->get();
        $data =[
            'appointments' => $appointments,
        ];
        return $data;
    }

    

    public function changeAppointmentDate($date,$id){
        DB::table('appointments')->where('id', '=', $id)->update(['date' => $date]);;
       return;
    }
    
     public function editAppointment(Request $request)
    {
    	$appointment = Appointment::find($request->appoinmentID);

    	$appointment->date = $request->date;
    	$appointment->color = $request->title;
        if($request->title == "#26B99A"){
            $title =" موعد لـ ";
        }
        else{
             $title =" مراجعة لـ ";
        }
    	$appointment->title = $title;
    	$appointment->time = $request->time;
    	$appointment->pacient_id = $request->patient;
        $appointment->save();

    }
    

     public function createAppointment(Request $request)
    {
        $user = Auth::user();
    	$appointment = new Appointment;

    	$appointment->date = $request->date;
    	$appointment->color = $request->title;
        if($request->has('doctor_id')){
            $appointment->doctor_id = $request->doctor_id;
        }
        else{
            $appointment->doctor_id = Auth::user()->user_name;
        }
    	
        if($request->title == "#26B99A"){
            $title =" موعد لـ ";
        }
        else{
             $title =" مراجعة لـ ";
        }
    	$appointment->title = $title;
    	$appointment->time = $request->time;
    	$appointment->pacient_id = $request->patient;
        if(Auth::user()->role == "Pacient"){
            $doc = User::where('user_name',$appointment->doctor_id)->first();
            $appointment->clinic_id = $doc->clinic_id;
        }
        else{
            $appointment->clinic_id = Auth::user()->clinic_id;
        }
    	
        if($user->role == "Pacient"){
            $appointment->is_approved = 0;
        }
        else{
            $appointment->is_approved = 1;
        }
    	
       $appointment->save();

    }
    

}