<?php

namespace App\Http\Controllers;

use App\Nurse;
use App\User;
use Auth;
use DB;
use App\Message;
use Illuminate\Http\Request;
use App\Services\NurseService;
    use Validator;
    use Illuminate\Validation\Rule;

class NursesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $nurse;
    public function __construct(NurseService $nurse){
        $this->middleware('auth');
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

        $validator = Validator::make($request->all(), [
            'ADName' => 'required|max:30',
            'ADemail' => 'required|email|max:255|unique:users,email',
            'ADpass' => 'required|min:8',
            'ADpass_2' => 'same:ADpass',
            'ADgender' => 'required',
            'ADuName' => 'required|max:50|unique:users,user_name',
            'ADphone' => 'required|phone',
            'ADaddress' => 'required|max:255',
            'ATimage' => 'sometimes|image',
            'id_image' => 'required|file',
            'ADsalary' => 'sometimes|numeric'
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

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
        $user = User::where('user_name',$user_name)->first();
        
        $validator = Validator::make($request->all(), [
            'ADName' => 'required|max:30',
            'ADemail' => [
                'required','email','max:255',
                'unique:users,email,'.$user->user_name.',user_name'
            ],
            'ADpass' => 'sometimes|min:8',
            'ADpass_2' => 'same:ADpass',
            'ADgender' => 'required',
            'ADuName' => [
                'required','max:50',
                'unique:users,user_name,'.$user->user_name.',user_name'
            ],
            'ADphone' => 'required|phone',
            'ADaddress' => 'required|max:255',
            'ATimage' => 'sometimes|image',
            'id_image' => 'sometimes|file',
            'ADsalary' => 'sometimes|numeric'
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->nurse->updateNurseWithUsername($request,$user_name);
        return redirect()->back();
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
