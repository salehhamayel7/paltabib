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
        $this->middleware('auth');
        $this->doctor = $doctor;

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
    
    public function showSearch()
    {

    	list($user , $clinic ,  $new_msgs , $money_notification) = $this->mainVars();


        return view('shared/search' , compact('user','clinic','new_msgs','money_notification'));

    }
    public function showDoctor()
    {

    	list($user , $clinic ,  $new_msgs , $money_notification) = $this->mainVars();

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

        return view('doctor/doctor_home' , compact('nextEvents','user','clinic','new_msgs','money_notification','today_events','appointments','appointmentsx','events_number'));
    }


    
    public function showDoctorMoney()
    {
        
        list($user , $clinic ,  $new_msgs , $money_notification) = $this->mainVars();

         $pacients = DB::table('users')->where([
            ['role', '=', 'Pacient'],
        ])->get();

        return view('doctor/doctor_money' , compact('user','clinic','new_msgs','money_notification','pacients'));
    }

    public function create(Request $request)
    {

    	$this->doctor->createDoctor($request);
    	return redirect()->back();

    }

    public function edit($username)
    {
        return $this->doctor->getDoctorWithUserName($username);
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
