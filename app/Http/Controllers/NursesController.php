<?php

namespace App\Http\Controllers;

use App\Nurse;
use App\User;
use Auth;
use DB;
use App\Message;
use Illuminate\Http\Request;
use App\Services\NurseService;

class NursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $nurse;
    public function __construct(NurseService $nurse){
        $this->nurse = $nurse;
    }
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->nurse->createNurse($request);
        return redirect()->back();

    }

    public function get($user_name)
    {
        return $this->nurse->getNurseWithUsername($user_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_name)
    {
        $this->nurse->updateNurseWithUsername($request,$user_name);
        return redirect()->back();
    }

    public function showAllNurses(){
        
        $user = Auth::user();
        $nurses = DB::table('nurses')
                    ->where('users.clinic_id',$user->clinic_id)
                    ->whereNotIn('nurses.user_name', [$user->user_name])
                    ->join('users', 'nurses.user_name', '=', 'users.user_name')
                    ->get();
        $clinic = DB::table('clinics')->where('id','=',$user->clinic_id)->first();
       $new_msgs = Message::where([
            ['receiver_id', '=', $user->user_name],
            ['seen', '=', '0'],
            ['receiver_available','=',1]
        ])
        ->join('users', 'messages.sender_id', '=', 'users.user_name')
        ->select('users.*', 'messages.*', 'messages.id as msg_id' , 'messages.created_at as msg_time')
        ->orderBy('messages.created_at', 'desc')->get();
        return view('nurses_administration' , compact('user','nurses','clinic','new_msgs'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($user_name)
    {
        $this->nurse->deleteNurseWithUsername($user_name);
        return redirect()->back();

    }
}
