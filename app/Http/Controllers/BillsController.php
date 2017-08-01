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
        $this->middleware('auth');
    	$this->bill = $bill; 
        
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
        
        list($user , $clinic ,  $new_msgs , $money_notification) = $this->mainVars();


        $expenses = DB::table('expences')->where([
            ['expences.clinic_id', '=', $user->clinic_id],
        ])
        ->join('users', 'expences.source', '=', 'users.user_name')
        ->select('expences.*', 'users.name as writter')
        ->orderBy('expences.created_at', 'desc')
        ->get();



        return view('shared/all_expenses' , compact('user','clinic','new_msgs','expenses','money_notification'));
    }

     public function showAllBills(){
        
        list($user , $clinic ,  $new_msgs , $money_notification) = $this->mainVars();


        $bills = DB::table('bills')->where([
            ['bills.clinic_id', '=', $user->clinic_id],
        ])
        ->join('users', 'bills.doctor_id', '=', 'users.user_name')
        ->select(DB::raw('bills.value-bills.paid_value AS remained_value, bills.*, users.name, users.user_name'))
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

        $doctors = DB::table('users')
            ->where('clinic_id', '=', $user->clinic_id)
            ->whereIn('role', ['Doctor', 'Manager,Doctor'])->get();

        return view('shared/all_bills' , compact('user','clinic','new_msgs','bills','pacients','doctors','money_notification'));
    }

    public function showrMoneyAdmin(){
        
        list($user , $clinic ,  $new_msgs , $money_notification) = $this->mainVars();


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

        $doctors = DB::table('users')
            ->where('clinic_id', '=', $user->clinic_id)
            ->whereIn('role', ['Doctor', 'Manager,Doctor'])->get();

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

        return view('shared/money_administration' , compact('user','clinic','new_msgs','pacients','doctors','bills','expenses','money_notification'));
    }



}
