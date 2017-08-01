<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EventService;

class EventsController extends Controller
{
    
    protected $event;

    public function __construct(EventService $event)
    {
        $this->middleware('auth');
    	$this->event = $event;
    }

    public function index()
    {
    	return $this->event->getAllEvents();
    }

    public function get($id)
    {
    	return $this->event->getEventWithid($id);
    }

    public function update(Request $request,$id)
    {
    	$this->event->updateEventWithid($request,$id);
        return redirect()->back();
    }

    public function create(Request $request)
    {
         $this->event->createEvent($request);
         return redirect()->back();
    }

    public function delete($id)
    {
    	$this->event->deleteEvent($id);
    	return redirect()->back();
    }
}
