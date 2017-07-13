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
    }

    

     public function showClinic(){
        
        $user = Auth::user();
       
        $clinic = DB::table('clinics')->where('manager_id','=',$user->user_name)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();

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
        return view('clinic' , compact('user','clinic','new_msgs','doctors_count','nurses_count','secretaries_count','patients_count'));
    }

    public function showManagerDoctors(){
        
        $user = Auth::user();
        $doctors = DB::table('users')
                    ->where('users.clinic_id',$user->clinic_id)
                    ->whereNotIn('doctors.user_name', [$user->user_name])
                    ->join('doctors', 'doctors.user_name', '=', 'users.user_name')
                    ->get();
        $clinic = DB::table('clinics')->where('manager_id','=',$user->user_name)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();
        return view('manager_doctors' , compact('user','doctors','clinic','new_msgs'));
    }

    public function showManager()
    {
        $user = Auth::user();
        $clinic = Clinic::where('manager_id' ,'=', $user->user_name)->first();
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
        
        return view('manager_home' , compact('nextEvents','billsPercentage','expencesPercentage','user','clinic','new_msgs','today_events','appointments','appointmentsx','events_number'));

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
