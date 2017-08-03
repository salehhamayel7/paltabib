<?php 

namespace App\Services;

use App\Bill;
use App\Expense;
use DB;
use Auth;
use Illuminate\Http\Request;

class BillService{

    


public function getExpenseWithID($expense_id)
    {
        $expence = DB::table('expences')
                ->where('id', $expense_id)
                ->first();
                
        $writter = DB::table('users')
                ->where('user_name', $expence->source)
                ->first();

        $data =[
            'expense' => $expence,
            'writter' => $writter,
        ];
        return $data;

    }
    public function getBillWithID($bill_id)
    {
        $bill = DB::table('bills')
                ->where('id', $bill_id)
                ->first();

        $doctor = DB::table('users')
                ->where('user_name', $bill->doctor_id)
                ->first();

        $pacient = DB::table('users')
                ->where('user_name', $bill->pacient_id)
                ->first();

        $writter = DB::table('users')
                ->where('user_name', $bill->source)
                ->first();

        $data =[
            'bill' => $bill,
            'doctor' => $doctor,
            'pacient' => $pacient,
            'writter' => $writter,
        ];
        return $data;

    }

    
    public function updateExpenses(Request $request)
    {
        $expense = Expense::find($request->expenseID);
    	$expense->value = $request->expenseValue;
        $expense->currency = $request->currency;
    	$expense->description = $request->expenseDesc;
        $expense->save();
    }

    public function updateBills(Request $request)
    {
        $bill = Bill::find($request->billID);
    	$bill->pacient_id = $request->billPacient;
    	$bill->doctor_id = $request->billDoctor;
    	$bill->value = $request->billValue;
        $bill->currency = $request->currency;
        $bill->paid_value = $request->billPainValue;
    	$bill->description = $request->billDesc;
        $bill->save();
    }

   public function createBill(Request $request)
    {
        
        $id_row = DB::table('receipts')
        ->where('clinic_id', Auth::user()->clinic_id)
        ->first();

    	$bill = new Bill;
        $bill->id = $id_row->last_id+1;
        $bill->clinic_id = Auth::user()->clinic_id;
    	$bill->pacient_id = $request->pacient;
    	$bill->doctor_id = $request->doctor;
        $bill->source = Auth::user()->user_name;
    	$bill->value = $request->value;
        $bill->paid_value = $request->paid_value;
        $bill->currency = $request->currency;
    	$bill->description = $request->description;
        $bill->save();

        DB::table('receipts')
            ->where('clinic_id', Auth::user()->clinic_id)
            ->update(['last_id' => $id_row->last_id+1]);

    }

    public function createExpense(Request $request)
    {
        
        $id_row = DB::table('receipts')
                ->where('clinic_id', Auth::user()->clinic_id)
                ->first();

        $expences = new Expense;
        $expences->id = $id_row->last_id+1;
        $expences->clinic_id = Auth::user()->clinic_id;
    	$expences->value = $request->value;
        $expences->currency = $request->currency;
        $expences->source = Auth::user()->user_name;
    	$expences->description = $request->description;
        $expences->save();

        DB::table('receipts')
            ->where('clinic_id', Auth::user()->clinic_id)
            ->update(['last_id' => $id_row->last_id+1]);

    }


    

}