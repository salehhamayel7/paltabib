<?php 

namespace App\Services;

use App\History;
use DB;
use Auth;
use Illuminate\Http\Request;
use Image;

class HistoryService{

    public function addHistory(Request $request)
    {
        $history = new History;

        $history->illness = $request->illness;
        $history->doctor_id = Auth::user()->user_name;
        $history->treatment = $request->treatment;
        $history->patient_id = $request->patient;
        if(request()->has('notes')){
		    $history->notes = $request->notes;
        }
        if($request->hasFile('ATimage')){
               $image = $request->file('ATimage');
               $imageName = $history->id.'.'.$image->getClientOriginalExtension();
               Image::make($image)->resize(300,300)->save(public_path("images\\histories\\". $imageName));
               $history->image = $imageName;
        }
        $history->save();
    }
}