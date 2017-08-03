<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SecretaryService;
use Auth;
use App\Clinic;
use App\Message;
use App\Event;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Validation\Rule;


class SecretariesController extends Controller
{
    protected $secretary;
    public function __construct(SecretaryService $secretary)
    {
        $this->middleware('auth');
        $this->secretary = $secretary;
    }

    

    public function create(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'ADName' => 'required|max:30',
            'ADemail' => 'required|email|max:255|unique:users,email',
            'ADpass' => 'required|min:8',
            'ADpass_2' => 'same:ADpass',
            'ADgender' => 'required',
            'ADuName' => 'required|max:50|unique:users,user_name',
            'ADphone' => 'required|phone',
            'ADaddress' => 'required|max:255',
            'ATimage' => 'sometimes|image',
            'id_image' => 'required|file',
            'ADsalary' => 'sometimes|numeric'
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $this->secretary->createSercretary($request);
        return redirect()->back();
    }

     public function edit($user_name)
    {
        $secretary = $this->secretary->getSecretaryWithUserName($user_name);
        $user = \App\User::where('user_name','=',$user_name)->first();
        $data = ['secretary' => $secretary, 'user' => $user];
        return $data;
    }

    public function update(Request $request,$user_name)
    {
        $this->secretary->updateSecretaryWithUserName($request,$user_name);
        return redirect()->back();
    }

    public function approveAppointment(Request $request)
    {
        dd($request);
    }

    public function showSecretary()
    {
        $user = Auth::user();
        $clinic = Clinic::where('id' ,'=', $user->clinic_id)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*',  'messages.*','messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();

        $money_notification = DB::table('bills')
            ->where('clinic_id', '=', $user->clinic_id)
            ->whereRaw('value != paid_value')->count();

        $current_date = date('Y-m-d');
        $ntexWeek = Carbon::tomorrow()->addDays(7)->toDateString();

        $temp = Event::where([
            ['clinic_id', '=', $clinic->id],
            ['date', '=', $current_date],
        ])
        ->get();
        $events_number = count($temp);

        $nextEvents  = Event::where([
            ['clinic_id', '=', $clinic->id],
            ['date', '>', $current_date],
            ['date', '<', $ntexWeek],
        ])
        ->orderBy('date', 'asc')
        ->get();

        $today_events = Event::where([
            ['clinic_id', '=', $clinic->id],
            ['date', '=', $current_date],
        ])
        ->orderBy('time', 'asc')
        ->paginate(4, ['*'], 'events');

        $appointmentsx = DB::table('appointments')->where([
            ['clinic_id', '=', $user->clinic_id],
            ['is_approved', '=', '0'],
        ])
        ->orderBy('date', 'asc')
        ->get();

        return view('secretary/secretary_home' , compact('appointmentsx','user','new_msgs','events_number','clinic','nextEvents','today_events','money_notification'));
    }

    
    

}
