<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use App\Services\MessageService;
use Auth;
use DB;

class MessageController extends Controller
{
    protected $message;
    public function __construct(MessageService $message){
        $this->message = $message;
    }

     public function getMessage($msg_id)
    {
        return $this->message->getMessageWithid($msg_id);
    }

    public function sawMessage($msg_id)
    {
        $this->message->sawMessageWithid($msg_id);
        return redirect()->back();

    }

    public function sendMessage(Request $request)
    {
        $this->message->sendMessages($request);
        return redirect()->back();

        
    }

     public function deleteMessage($deleter,$msg_id)
    {
        $this->message->deleteMessageWithid($deleter,$msg_id);
        return redirect()->back();

    }


    public function showInbox($msg_id="xxx")
    {
         $user = Auth::user();
        if($msg_id=="xxx"){
            $currentmsg = DB::table('messages')->where([
                ['receiver_id','=',$user->user_name],
                ['receiver_available','=',1]
                ])
                ->join('users', 'messages.sender_id', '=', 'users.user_name')
                ->select('users.*',  'messages.*','messages.id as msg_id' , 'messages.created_at as msg_time')
                ->latest('messages.created_at')->first();
        }
        else{
            $currentmsg = DB::table('messages')
                ->where('messages.id',$msg_id)
                ->join('users', 'messages.sender_id', '=', 'users.user_name')
                ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
                ->latest('messages.created_at')->first();
            DB::table('messages')->where('messages.id',$msg_id)->update(['seen' => 1]);
        }

        $clinic = DB::table('clinics')->where('id','=',$user->clinic_id)->first();

        $msgs = DB::table('messages')->where([
            ['receiver_id','=',$user->user_name],['receiver_available','=',1]
            ])
            ->join('users', 'messages.sender_id', '=', 'users.user_name')
            ->select('users.*','messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
            ->orderBy('messages.created_at', 'desc')
            ->paginate(6, ['*'], 'msgs');

        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();
         
         if($user->role=="Pacient"){
            $doctorsx = DB::table('users')
                ->whereIn('role', ['Doctor', 'Manager,Doctor', 'Manager'])
                ->whereNotIn('user_name', [$user->user_name])->get();
            $doctors = array();
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
                    array_push($doctors, $doctor);
                }
            }
         }
         else{
             $doctors = DB::table('users')->where([
                    ['clinic_id', '=', $user->clinic_id],
                ])
                ->whereIn('role', ['Doctor', 'Manager,Doctor', 'Manager'])
                ->whereNotIn('user_name', [$user->user_name])->get();

         }
         

         $secretaries = DB::table('users')->where([
            ['clinic_id', '=', $user->clinic_id],
            ['role', '=', 'Secretary'],
        ])->whereNotIn('user_name', [$user->user_name])->get();
        
        $nurses = DB::table('users')->where([
            ['clinic_id', '=', $user->clinic_id],
            ['role', '=', 'Nurse'],
        ])->whereNotIn('user_name', [$user->user_name])->get();

        $temp_patients = DB::table('users')
                    ->where('role', '=', "Pacient")
                    ->whereNotIn('users.user_name', [$user->user_name])
                    ->join('pacients', 'pacients.user_name', '=', 'users.user_name')
                    ->get();
        
        $pacirnts = array();
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
                    array_push($pacirnts, $patient);
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
                    array_push($pacirnts, $patient);
                }
            }
        }
        return view('inbox' , compact('user','msgs','clinic','new_msgs','currentmsg','nurses','doctors','secretaries','pacirnts'));
    }

    public function showOutbox()
    {
        $user = Auth::user();
        $clinic = DB::table('clinics')->where('id','=',$user->clinic_id)->first();
        $msgs = DB::table('messages')->where([
                ['sender_id','=',$user->user_name],
                ['sender_available','=',1]
            ])
             ->join('users', 'messages.receiver_id', '=', 'users.user_name')
            ->select('users.*','messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
            ->orderBy('messages.created_at', 'desc')
            ->paginate(6, ['*'], 'msgs');
       $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();

        $currentmsg = DB::table('messages')->where([
                ['sender_id','=',$user->user_name],
                ['sender_available','=',1]
                ])
                ->join('users', 'messages.receiver_id', '=', 'users.user_name')
                ->select('users.*',  'messages.*','messages.id as msg_id' , 'messages.created_at as msg_time')
                ->latest('messages.created_at')->first();

        if($user->role=="Pacient"){
             $doctorsx = DB::table('users')
                ->whereIn('role', ['Doctor', 'Manager,Doctor', 'Manager'])
                ->whereNotIn('user_name', [$user->user_name])->get();
            $doctors = array();
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
                    array_push($doctors, $doctor);
                }
            }
         }
         else{
             $doctors = DB::table('users')->where([
                    ['clinic_id', '=', $user->clinic_id],
                ])
                ->whereIn('role', ['Doctor', 'Manager,Doctor', 'Manager'])
                ->whereNotIn('user_name', [$user->user_name])->get();

         }

         $secretaries = DB::table('users')->where([
            ['clinic_id', '=', $user->clinic_id],
            ['role', '=', 'Secretary'],
        ])->get();
        
        $nurses = DB::table('users')->where([
            ['clinic_id', '=', $user->clinic_id],
            ['role', '=', 'Nurse'],
        ])->get();

        $temp_patients = DB::table('users')
                    ->whereNotIn('users.user_name', [$user->user_name])
                    ->join('pacients', 'pacients.user_name', '=', 'users.user_name')
                    ->get();
        
        $pacirnts = array();
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
                    array_push($pacirnts, $patient);
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
                    array_push($pacirnts, $patient);
                }
            }
        }
       
        return view('outbox' , compact('pacirnts','currentmsg','user','msgs','clinic','new_msgs','nurses','doctors','secretaries'));
    }

}
