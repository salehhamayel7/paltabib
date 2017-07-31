<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AppointmentService;
use Auth;
use DB;
use App\Clinic;
use App\Message;

class AppointmentController extends Controller
{
    //
    protected $appointment;

    public function __construct(AppointmentService $appointment)
    {
    	$this->appointment = $appointment;

        $this->middleware(function ($request, $next) {

             $this->user = Auth::user();
       
             $this->clinic = Clinic::where('id' ,'=', $this->user->clinic_id)->first();

             $this->new_msgs = Message::where([
                ['receiver_id', '=', $this->user->user_name],
                ['seen', '=', '0'],
                ['receiver_available','=',1]
            ])
            ->join('users', 'messages.sender_id', '=', 'users.user_name')
            ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
            ->orderBy('messages.created_at', 'desc')->get();
            
             $this->money_notification = DB::table('bills')
                ->where('clinic_id', '=', $this->user->clinic_id)
                ->whereRaw('value != paid_value')->count();
            

            return $next($request);
        });

    }

    public function mainVars()
    {
        $user = $this->user;
        $clinic = $this->clinic;
        $new_msgs = $this->new_msgs;
        $money_notification = $this->money_notification;
        return [$user , $clinic ,  $new_msgs, $money_notification];
    }

    public function delete($id)
    {
    	$this->appointment->deleteAppointment($id);
    	return redirect()->back();
    }

    public function approve($id)
    {
    	$this->appointment->approveAppointment($id);
    	return redirect()->back();
    }

    
    public function showCalendarD()
    {
        
        list($user , $clinic ,  $new_msgs , $money_notification) = $this->mainVars();

        $doctorS = DB::table('users')
            ->where('clinic_id', $user->clinic_id)
            ->whereIn('role', ['Doctor','Manager,Doctor'])
            ->whereNotIn('user_name', [$user->user_name])->get();
        
        $temp_patients = DB::table('pacients')
                    ->whereNotIn('pacients.user_name', [$user->user_name])
                    ->join('users', 'pacients.user_name', '=', 'users.user_name')
                    ->select('users.*', 'pacients.job' ,'pacients.ensurance_number')
                    ->get();
        
        $patients = array();
        foreach($temp_patients as $patient){
            $temp_patient = DB::table('patient_clinic')
                    ->where([
                        ['patient_id', '=', $patient->user_name],
                        ['clinic_id', '=', $user->clinic_id],
                    ])->get();
            if(count($temp_patient) > 0){
                array_push($patients, $patient);
            }
        }
       
        return view('shared/calendarD' , compact('user','clinic','new_msgs','patients','doctorS','money_notification'));
    }

    public function showCalendar()
    {
        
        list($user , $clinic ,  $new_msgs , $money_notification) = $this->mainVars();

        if($user->role == "Pacient"){
            $doctorsx = DB::table('users')
                ->whereIn('role', ['Doctor', 'Manager,Doctor'])
                ->whereNotIn('user_name', [$user->user_name])->get();
            $doctorS = array();
            foreach($doctorsx as $doctor){
                $temp1 = DB::table('appointments')
                    ->where([
                        ['pacient_id', '=', Auth::user()->user_name],
                        ['doctor_id', '=', $doctor->user_name],
                    ])->get();
                $temp2 = DB::table('histories')
                    ->where([
                        ['patient_id', '=', Auth::user()->user_name],
                        ['doctor_id', '=', $doctor->user_name],
                    ])->get();
                if(count($temp1) > 0 || count($temp2) > 0){
                    array_push($doctorS, $doctor);
                }
            }
        }
        else{
             $doctorS = DB::table('users')
                    ->where('users.clinic_id',$user->clinic_id)
                    ->whereIn('role', ["Doctor", "Manager,Doctor"])
                    ->get();
        }
       

        $temp_patients = DB::table('pacients')
                    ->whereNotIn('pacients.user_name', [$user->user_name])
                    ->join('users', 'pacients.user_name', '=', 'users.user_name')
                    ->select('users.*', 'pacients.job' ,'pacients.ensurance_number')
                    ->get();
        
        $patients = array();
        foreach($temp_patients as $patient){
            $temp_patient = DB::table('patient_clinic')
                    ->where([
                        ['patient_id', '=', $patient->user_name],
                        ['clinic_id', '=', $user->clinic_id],
                    ])->get();
            if(count($temp_patient) > 0){
                array_push($patients, $patient);
            }
        }
       
        return view('shared/calendar' , compact('user','clinic','new_msgs','patients','doctorS','money_notification'));
    }

    

    public function showPatientCalendar()
    {
        
        list($user , $clinic ,  $new_msgs , $money_notification) = $this->mainVars();
         $doctorsx = DB::table('users')
                ->whereIn('role', ['Doctor', 'Manager,Doctor'])
                ->whereNotIn('user_name', [$user->user_name])->get();
            $doctorS = array();
            foreach($doctorsx as $doctor){
                $temp1 = DB::table('appointments')
                    ->where([
                        ['pacient_id', '=', Auth::user()->user_name],
                        ['doctor_id', '=', $doctor->user_name],
                    ])->get();
                $temp2 = DB::table('histories')
                    ->where([
                        ['patient_id', '=', Auth::user()->user_name],
                        ['doctor_id', '=', $doctor->user_name],
                    ])->get();
                if(count($temp1) > 0 || count($temp2) > 0){
                    array_push($doctorS, $doctor);
                }
            }
        return view('patient/calendar' , compact('user','clinic','doctorS','new_msgs','money_notification'));
    }

    
    public function showAppointments($id)
    {
        return $this->appointment->showDocAppointments($id);
    }

    public function getAppointments($id = "xx")
    {
        if($id == "xx"){
             return $this->appointment->getAllAppointments();
        }
        else{
            return $this->appointment->getAppointmentWithid($id);
        }
       
    }

    
    public function editAppointment(Request $request)
    {
        $this->appointment->editAppointment($request);
        return redirect()->back();
    }

    public function createAppointment(Request $request)
    {
        $this->appointment->createAppointment($request);
        return redirect()->back();
    }

    public function changeAppointmentDate($date,$id)
    {
        $this->appointment->changeAppointmentDate($date,$id);
    }

    public function getPatietsAppointmens()
    {
        return $this->appointment->getPatietsAppointmens();
    }

    public function createPatietsAppointmens(Request $request)
    {
         $this->appointment->createAppointment($request);
         return redirect()->back();
    }


}
