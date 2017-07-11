<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BillService;
use Auth;
use DB;
use App\Clinic;
use App\Message;

class BillsController extends Controller
{
    protected $bill;

    public function __construct(BillService $bill)
    {
    	$this->bill = $bill;
    }

    
    public function updateBill(Request $request)
    {
    	$this->bill->updateBills($request);
        return redirect()->back();

    }
    public function updateExpense(Request $request)
    {
    	$this->bill->updateExpenses($request);
        return redirect()->back();

    }

    

    public function getExpense($expense_id)
    {
    	return $this->bill->getExpenseWithID($expense_id);

    }
    
    public function getBill($bill_id)
    {
    	return $this->bill->getBillWithID($bill_id);

    }

    public function createBills(Request $request)
    {

    	$this->bill->createBill($request);
    	return redirect()->back();

    }

    public function createExpenses(Request $request)
    {

    	$this->bill->createExpense($request);
    	return redirect()->back();

    }

    public function showAllExpenses(){
        
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

        $expenses = DB::table('expences')->where([
            ['clinic_id', '=', $user->clinic_id],
        ])
        ->orderBy('created_at', 'desc')
        ->get();

         $temp_pacients = DB::table('users')->where([
                ['role', '=', 'Pacient'],
            ])->get();
        
        $pacients = array();
        foreach($temp_pacients as $patient){
            $temp_patient = DB::table('patient_clinic')
                    ->where([
                        ['patient_id', '=', $patient->user_name],
                        ['clinic_id', '=', $user->clinic_id],
                    ])->get();
            if(count($temp_patient) > 0){
                array_push($pacients, $patient);
            }
        }

        $doctors = DB::table('users')->where([
            ['clinic_id', '=', $user->clinic_id],
            ['role', '=', 'Doctor'],
        ])->get();

        return view('all_expenses' , compact('user','clinic','new_msgs','expenses','pacients','doctors'));
    }

     public function showAllBills(){
        
        $user = Auth::user();
        $clinic = DB::table('clinics')->where('id','=',$user->clinic_id)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*',  'messages.*','messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();

        $bills = DB::table('bills')->where([
            ['bills.clinic_id', '=', $user->clinic_id],
        ])
        ->join('users', 'bills.doctor_id', '=', 'users.user_name')
        ->select('bills.*', 'users.name', 'users.user_name')
        ->orderBy('bills.created_at', 'desc')
        ->get();

         $temp_pacients = DB::table('users')->where([
                ['role', '=', 'Pacient'],
            ])->get();
        
        $pacients = array();
        foreach($temp_pacients as $patient){
            $temp_patient = DB::table('patient_clinic')
                    ->where([
                        ['patient_id', '=', $patient->user_name],
                        ['clinic_id', '=', $user->clinic_id],
                    ])->get();
            if(count($temp_patient) > 0){
                array_push($pacients, $patient);
            }
        }

        $doctors = DB::table('users')->where([
            ['clinic_id', '=', $user->clinic_id],
            ['role', '=', 'Doctor'],
        ])->get();

        return view('all_bills' , compact('user','clinic','new_msgs','bills','pacients','doctors'));
    }

    public function showrMoneyAdmin(){
        
        $user = Auth::user();
        $clinic = DB::table('clinics')->where('id','=',$user->clinic_id)->first();
        $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();

       $temp_pacients = DB::table('users')->where([
                ['role', '=', 'Pacient'],
            ])->get();
        
        $pacients = array();
        foreach($temp_pacients as $patient){
            $temp_patient = DB::table('patient_clinic')
                    ->where([
                        ['patient_id', '=', $patient->user_name],
                        ['clinic_id', '=', $user->clinic_id],
                    ])->get();
            if(count($temp_patient) > 0){
                array_push($pacients, $patient);
            }
        }

        $doctors = DB::table('users')->where([
            ['clinic_id', '=', $user->clinic_id],
            ['role', '=', 'Doctor'],
        ])->get();

        $bills = DB::table('bills')->where([
            ['clinic_id', '=', $user->clinic_id],
        ])
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        $expenses  = DB::table('expences')->where([
            ['clinic_id', '=', $user->clinic_id],
        ])
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        return view('money_administration' , compact('user','clinic','new_msgs','pacients','doctors','bills','expenses'));
    }



}
