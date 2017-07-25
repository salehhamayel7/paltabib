<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ManagerService;
use Auth;
use App\Clinic;
use App\Message;
use App\Event;
use App\Doctor;
use App\Secretaries;
use DB;
use App\Nurse;
use App\Pacient;
use Carbon\Carbon;

class ManagerController extends Controller
{
    //
    protected $manager;

    public function __construct(ManagerService $manager){
        $this->manager = $manager;

        $this->middleware(function ($request, $next) {

             $this->user = Auth::user();
       
             $this->clinic = DB::table('clinics')->where('manager_id','=',$this->user->user_name)->first();

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


     public function showClinic(){
        
        list($user , $clinic ,  $new_msgs , $money_notification) = $this->mainVars();

        $doctors = DB::table('users')
        ->where([
                ['clinic_id',$user->clinic_id],
                ['role',"Doctor"],
            ])->get();
        $doctors_count = count( $doctors);

        $nurses = DB::table('users')
        ->where([
                ['clinic_id',$user->clinic_id],
                ['role',"Nurse"],
            ])->get();
        $nurses_count = count( $nurses);

        $secretaries = DB::table('users')
        ->where([
                ['clinic_id',$user->clinic_id],
                ['role',"Secretary"],
            ])->get();
        $secretaries_count = count( $secretaries);

        $patients = DB::table('patient_clinic')
        ->where([
                ['clinic_id',$user->clinic_id],
            ])->get();       
        $patients_count = count( $patients);

        $appointments = DB::table('appointments')
        ->where([
                ['clinic_id',$user->clinic_id],
            ])->get();
        $appointments_count = count( $appointments);

        $events = DB::table('events')
        ->where([
                ['clinic_id',$user->clinic_id],
            ])->get();
        $events_count = count( $events);

        return view('manager/clinic' , compact('user','clinic','new_msgs','doctors_count','nurses_count','secretaries_count','patients_count','events_count','appointments_count','money_notification'));
    }

    public function showManagerDoctors(){
        
        list($user , $clinic ,  $new_msgs, $money_notification)=$this->mainVars();

        $doctors = DB::table('users')
                    ->where('users.clinic_id',$user->clinic_id)
                    ->whereNotIn('doctors.user_name', [$user->user_name])
                    ->join('doctors', 'doctors.user_name', '=', 'users.user_name')
                    ->get();
        
        return view('manager/manager_doctors' , compact('user','doctors','clinic','new_msgs','money_notification'));
    }


    public function showAllNurses(){
        
        list($user , $clinic ,  $new_msgs, $money_notification)=$this->mainVars();

        $nurses = DB::table('nurses')
                    ->where('users.clinic_id',$user->clinic_id)
                    ->whereNotIn('nurses.user_name', [$user->user_name])
                    ->join('users', 'nurses.user_name', '=', 'users.user_name')
                    ->get();
       
        return view('manager/nurses_administration' , compact('user','nurses','clinic','new_msgs','money_notification'));
    }

    public function showAllSecretaries(){
        
        list($user , $clinic ,  $new_msgs, $money_notification)=$this->mainVars();

        $secretaries = DB::table('secretaries')
                    ->where('users.clinic_id',$user->clinic_id)
                    ->whereNotIn('secretaries.user_name', [$user->user_name])
                    ->join('users', 'secretaries.user_name', '=', 'users.user_name')
                    ->get();
        
        return view('manager/secretaries_administration' , compact('user','secretaries','clinic','new_msgs','money_notification'));
    }

    public function showManager()
    {
        list($user , $clinic ,  $new_msgs, $money_notification)=$this->mainVars();

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

        $tomorrow = Carbon::tomorrow()->toDateString();
        $ntexWeek = Carbon::tomorrow()->addDays(7)->toDateString();
        $nextEvents  = Event::where([
            ['clinic_id', '=', $clinic->id],
            ['date', '>=', $tomorrow],
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

        $start = Carbon::now()->startOfMonth();

        $bills = DB::table('bills')
                     ->select(DB::raw('Sum(value) as billsValue'))
                     ->where([
                             ['created_at', '>=', $start],
                             ['clinic_id' , $user->clinic_id]
                         ])
                     ->first();
        $expences = DB::table('expences')
                     ->select(DB::raw('Sum(value) as expencesValue'))
                     ->where([
                             ['created_at', '>=', $start],
                             ['clinic_id' , $user->clinic_id]
                         ])
                     ->first();
        
        $total = $bills->billsValue + $expences->expencesValue;
        if($total == 0){
            $billsPercentage = 0;
            $expencesPercentage = 0;
        }
        else{
            $billsPercentage = ceil(100 * $bills->billsValue / $total);
            $expencesPercentage = floor(100 *  $expences->expencesValue / $total);
        }
        
        return view('manager/manager_home' , compact('nextEvents','billsPercentage','money_notification','expencesPercentage','user','clinic','new_msgs','today_events','appointments','appointmentsx','events_number'));

    }
    
    public function edit(Request $request)
    {
        return $this->manager->editManager($request);
    }

    public function changeProfilePic(Request $request)
    {
        return $this->manager->changePic($request);
    }

    public function updateClinic(Request $request)
    {
         $this->manager->updateClinic($request);
         return redirect()->back();
    }


}
