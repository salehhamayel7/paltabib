<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pacient;
use App\User;
use App\Event;
use Auth;
use App\Appointment;
use App\Message;
use App\Services\PacientService;
use Carbon\Carbon;
use DB;


class PacientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $pacient;
    public function __construct(PacientService $pacient){
        $this->pacient = $pacient;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $this->pacient->bookAppointemnt($request->all());
         return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->pacient->createPacient($request);
        return redirect()->back();
    }


    public function get($user_name)
    {
        return $this->pacient->getPacientWithUsername($user_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_name)
    {
        $this->pacient->updatePacientWithUsername($request,$user_name);
        return redirect()->back();
    }

    public function changePic(Request $request)
    {
        $this->pacient->changePicture($request);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function delete($user_name)
    {
        $this->pacient->deletePacientWithUsername($user_name);
        return redirect()->back();

    }

     public function showAllPacients(){
        
        $user = Auth::user();
        $temp_patients = DB::table('pacients')
                    ->whereNotIn('pacients.user_name', [$user->user_name])
                    ->join('users', 'pacients.user_name', '=', 'users.user_name')
                    ->select('users.*', 'pacients.job' ,'pacients.ensurance_number')
                    ->get();
        
        $pacirnts = array();
        foreach($temp_patients as $patient){
            $temp_patient = DB::table('patient_clinic')
                    ->where([
                        ['patient_id', '=', $patient->user_name],
                        ['clinic_id', '=', $user->clinic_id],
                    ])->get();
            if(count($temp_patient) > 0){
                array_push($pacirnts, $patient);
            }
        }

        $clinic = DB::table('clinics')->where('id','=',$user->clinic_id)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();
        return view('patient_administration' , compact('user','pacirnts','clinic','new_msgs'));
    }

    public function showRecord($user_name){
        
        $user = Auth::user();
        $clinic = DB::table('clinics')->where('id','=',$user->clinic_id)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
            ->join('users', 'messages.sender_id', '=', 'users.user_name')
            ->select('users.*', 'messages.*','messages.id as msg_id' , 'messages.created_at as msg_time')
            ->orderBy('messages.created_at', 'desc')->get();

        $patient = DB::table('users')
            ->where('users.user_name', $user_name)
            ->join('pacients', 'pacients.user_name', '=', 'users.user_name')
            ->select('users.*', 'pacients.*', 'pacients.id as patient_id')
            ->first();
        
        $histories = DB::table('histories')
            ->where([
                ['patient_id', '=', $user_name],
                ['doctor_id', '=', $user->user_name],
            ])
             ->orderBy('created_at', 'desc')
             ->paginate(4, ['*'], 'histories');
        
        return view('record' , compact('user','clinic','new_msgs','patient','pacients','histories'));
    }


    public function showMyRecord(){
        
        $user = Auth::user();
        $clinic = DB::table('clinics')->where('id','=',$user->clinic_id)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
            ->join('users', 'messages.sender_id', '=', 'users.user_name')
            ->select('users.*', 'messages.*','messages.id as msg_id' , 'messages.created_at as msg_time')
            ->orderBy('messages.created_at', 'desc')->get();

        $patient = DB::table('users')
            ->where('users.user_name', $user->user_name)
            ->join('pacients', 'pacients.user_name', '=', 'users.user_name')
            ->select('users.*', 'pacients.*', 'pacients.id as patient_id')
            ->first();
        
        $histories = DB::table('histories')
            ->where([
                ['patient_id', '=', $user->user_name],
            ])
                ->join('users', 'histories.doctor_id', '=', 'users.user_name')
                ->join('clinics', 'clinics.id', '=', 'users.clinic_id')
                ->select('users.*', 'histories.*', 'users.image as user_image', 'clinics.name as clinic_name')
                ->orderBy('histories.created_at', 'desc')
                ->paginate(10, ['*'], 'histories');
        
        return view('record' , compact('user','clinic','new_msgs','patient','pacients','histories'));
    }


    public function showAllRecords(){
        
        $user = Auth::user();

        $clinic = DB::table('clinics')->where('id','=',$user->clinic_id)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*','messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();

        $temp_pacients = DB::table('users')->where([
                ['role', '=', 'Pacient'],
            ])->get();
        
        $patients = array();
        foreach($temp_pacients as $patient){
            $temp_patient = DB::table('patient_clinic')
                    ->where([
                        ['patient_id', '=', $patient->user_name],
                        ['clinic_id', '=', $user->clinic_id],
                    ])->get();
            if(count($temp_patient) > 0){
                array_push($patients, $patient);
            }
        }


        $temp_patients = DB::table('pacients')
                    ->whereNotIn('pacients.user_name', [$user->user_name])
                    ->join('users', 'pacients.user_name', '=', 'users.user_name')
                    ->select('users.*', 'pacients.job' ,'pacients.ensurance_number')
                    ->get();
        
        $pacients = array();
         if($user->role=="Doctor"){
             foreach($temp_patients as $patient){
                $temp_patient1 = DB::table('appointments')
                    ->where([
                        ['pacient_id', '=', $patient->user_name],
                        ['doctor_id', '=', Auth::user()->user_name],
                    ])->get();
                $temp_patient2 = DB::table('histories')
                    ->where([
                        ['patient_id', '=', $patient->user_name],
                        ['doctor_id', '=', Auth::user()->user_name],
                    ])->get();
                if(count($temp_patient1) > 0 || count($temp_patient2) > 0){
                    array_push($pacients, $patient);
                }
            }
        }
        else{
             
            foreach($temp_patients as $patient){
                $temp_patient = DB::table('patient_clinic')
                        ->where([
                            ['patient_id', '=', $patient->user_name],
                            ['clinic_id', '=', $user->clinic_id],
                        ])->get();
                if(count($temp_patient) > 0){
                    array_push($pacients, $patient);
                }
            }
        }
        
        return view('patientsRecords' , compact('user','clinic','new_msgs','patients','pacients'));
    }

    public function showPacient()
    {
        $user = Auth::user();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*','messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();

        $today = Carbon::today()->toDateString();
        $ntexWeek = Carbon::today()->addDays(7)->toDateString();
        $nextAppoinments  = Appointment::where([
            ['pacient_id', '=', $user->user_name],
            ['date', '>=', $today],
            ['date', '<', $ntexWeek],
            ['is_approved', '=', 1],
        ])
        ->join('users', 'appointments.doctor_id', '=', 'users.user_name')
        ->join('clinics', 'clinics.id', '=', 'users.clinic_id')
        ->select( 'clinics.address as location','clinics.name as clinic_name','users.*','appointments.*','users.id as user_id')
        ->orderBy('date', 'asc')
        ->get();

        $today = Carbon::today()->toDateString();
        $ntexWeek = Carbon::today()->addDays(7)->toDateString();
        $nextEvents  = Event::where([
            ['date', '>=', $today],
            ['date', '<', $ntexWeek],
        ])
        ->join('clinics', 'clinics.id', '=', 'events.clinic_id')
        ->orderBy('date', 'asc')
        ->get();
        return view('pacient_home' , compact('user','nextAppoinments','nextEvents','new_msgs'));
    }


    public function showPacientCalendar()
    {
        $user = Auth::user();
       
        return view('pacient_calendar' , compact('user'));
    }
    
}
