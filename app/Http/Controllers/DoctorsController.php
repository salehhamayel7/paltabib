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
use Validator;
use Illuminate\Validation\Rule;


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
            
            if($this->user->role == 'Doctor'){
                $this->money_notification = DB::table('bills')
                    ->where(function ($query) {
                        $query->whereRaw('value != paid_value')
                            ->where([
                                ['clinic_id', '=', $this->user->clinic_id],
                                ['doctor_id', '=', $this->user->user_name],
                            ]);
                        })
                    ->orWhere(function ($query) {
                        $query->whereRaw('value != paid_value')
                            ->where([
                                ['clinic_id', '=', $this->user->clinic_id],
                                ['source', '=', $this->user->user_name],
                            ]);
                        })
                    ->count();
            }
            else{
                $this->money_notification = DB::table('bills')
                    ->where('clinic_id', '=', $this->user->clinic_id)
                    ->whereRaw('value != paid_value')->count();
            }

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
        $currencies  = DB::table('countries')->select('currency_code')->where('currency_code', '<>', '')->whereNotNull('currency_code')->distinct()->orderBy('currency_code', 'asc')->get();
         $pacients = DB::table('users')->where([
            ['role', '=', 'Pacient'],
        ])->get();

        return view('shared/money_administration' , compact('user','clinic','new_msgs','money_notification','pacients','currencies'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ADName' => 'required|max:30',
            'ADemail' => 'required|email|max:255|unique:users,email',
            'ADpass' => 'required|min:8',
            'ADpass_2' => 'same:ADpass',
            'ADgender' => 'required',
            'ADuName' => 'required|unique:users,user_name',
            'ADphone' => 'required|phone',
            'ADmajor' => 'required|max:50',
            'ADaddress' => 'required|max:255',
            'ATimage' => 'sometimes|image',
            'id_image' => 'required|file',
            'ADsalary' => 'sometimes|numeric',
            'ADnumber' => 'required|numeric'
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


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
        $user = User::where('user_name',$user_name)->first();
        $validator = Validator::make($request->all(), [
            'ADName' => 'required|max:30',
            'ADemail' => [
                'required','email','max:255',
                'unique:users,email,'.$user->user_name.',user_name'
            ],
            'ADpass' => 'sometimes|min:8',
            'ADpass_2' => 'same:ADpass',
            'ADgender' => 'required',
            'ADuName' => [
                'required','max:50',
                'unique:users,user_name,'.$user->user_name.',user_name'
            ],
            'ADphone' => 'required|phone',
            'ADmajor' => 'required|max:50',
            'ADaddress' => 'required|max:255',
            'ATimage' => 'sometimes|image',
            'id_image' => 'sometimes|file',
            'ADsalary' => 'sometimes|numeric',
            'ADnumber' => 'required|numeric'
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $this->doctor->updateDoctorWithUserName($request,$user_name);
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $this->doctor->advanceSearch($request->all());
    }



}
