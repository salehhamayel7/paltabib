<?php

namespace App\Http\Controllers;

use App\Services\DoctorService;
use Illuminate\Http\Request;
use Auth;
use App\Clinic;
use App\Message;
use App\Event;
use Carbon\Carbon;
use DB;

class DoctorsController extends Controller
{
	protected $doctor;
	public function __construct(DoctorService $doctor)
	{
        $this->doctor = $doctor;
	}

    
    public function showSearch()
    {

    	$user = Auth::user();
        $clinic = Clinic::where('id' ,'=', $user->clinic_id)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();


        return view('search' , compact('user','clinic','new_msgs'));

    }
    public function showDoctor()
    {

    	$user = Auth::user();
        $clinic = Clinic::where('id' ,'=', $user->clinic_id)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();

        $current_date = date('Y-m-d');
        $today_events = Event::where([
            ['clinic_id', '=', $clinic->id],
            ['date', '=', $current_date],
        ])
        ->orderBy('time', 'asc')
        ->paginate(4, ['*'], 'events');

        $temp = Event::where([
            ['clinic_id', '=', $clinic->id],
            ['date', '=', $current_date],
        ])
        ->get();
        $events_number = count($temp);

        $current_date = date('Y-m-d');
        $ntexWeek = Carbon::tomorrow()->addDays(7)->toDateString();
        $nextEvents  = Event::where([
            ['clinic_id', '=', $clinic->id],
            ['date', '>', $current_date],
            ['date', '<', $ntexWeek],
        ])
        ->orderBy('date', 'asc')
        ->get();

        $appointments = DB::table('appointments')->where([
            ['doctor_id', '=', $user->user_name],
            ['date', '=', $current_date],
            ['is_approved', '=', '1'],
        ])
        ->orderBy('time', 'asc')
        ->paginate(5, ['*'], 'appointments');

        $appointmentsx = DB::table('appointments')->where([
            ['doctor_id', '=', $user->user_name],
            ['is_approved', '=', '0'],
        ])
        ->orderBy('date', 'asc')
        ->get();

        return view('doctor_home' , compact('nextEvents','user','clinic','new_msgs','today_events','appointments','appointmentsx','events_number'));

    }


    
    public function showDoctorMoney()
    {
        
        $user = Auth::user();
        $clinic = Clinic::where('id' ,'=', $user->clinic_id)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();

         $pacients = DB::table('users')->where([
            ['role', '=', 'Pacient'],
        ])->get();

        return view('doctor_money' , compact('user','clinic','new_msgs','pacients'));
    }

    public function create(Request $request)
    {

    	$this->doctor->createDoctor($request);
    	return redirect()->back();

    }

    public function edit($user_name)
    {
        $doctor = $this->doctor->getDoctorWithUserName($user_name);
        $user = \App\User::where('user_name','=',$user_name)->first();
        $data = ['doctor' => $doctor, 'user' => $user];
        return $data;
    }
    
     public function changePic(Request $request)
    {
        $this->doctor->changePicture($request);
        return redirect()->back();
    }

    public function update(Request $request, $user_name)
    {
        $this->doctor->updateDoctorWithUserName($request,$user_name);
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $this->doctor->advanceSearch($request->all());
    }



}
