<?php 

namespace App\Services;

use App\Event;
use DB;
use Auth;
use Illuminate\Http\Request;

class EventService{


	public function getAllEvents(){

		return Event::all();
	}

	public function getEventWithid($id){

		$event = DB::table('events')
                ->where('id', $id)
                ->first();
		$data =[
            'event' => $event,
        ];
        return $data;
	}

	public function updateEventWithid(Request $request,$id){

		$event = Event::find($id);
    	$event->event_name = $request->name;
    	$event->event_description	 = $request->description	;
		$event->date = $request->date;
    	$event->time = $request->time;
        $event->save();
		
	}

	
	
	
	public function deleteEvent($id)
	{
         DB::table('events')->where('id',$id)->delete();
         
	}
	public function createEvent(Request $request)
	{
		$event = new Event;

        $event->event_name = $request->name;
        $event->clinic_id = Auth::user()->clinic_id;
        $event->date = $request->date;
        $event->time = $request->time;
		$event->event_description = $request->description;
        $event->save();
    }
}