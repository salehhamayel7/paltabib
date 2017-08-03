<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClinicService;
use Validator;
use Illuminate\Validation\Rule;


class ClinicController extends Controller
{
    //
    protected $clinic;
	public function __construct(ClinicService $clinic)
	{
        $this->middleware('auth');
        $this->clinic = $clinic;
	}

   
    public function banOrNotClinic($id)
    {
        return $this->clinic->banOrNotClinic($id);
    }

    public function deleteClinic($id)
    {
        $this->clinic->deleteClinic($id);
        return redirect()->back();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'same:password',
            'gender' => 'required',
            'user_name' => 'required|unique:users,user_name',
            'phone' => 'required|phone',
            'role' => 'required',
            'address' => 'required|max:255',
            'clinic_phone' => 'required|phone',
            'clinic_address' => 'required|max:100',
            'clinic' => 'required|max:50',
            'image' => 'sometimes|image',
            'id_image' => 'required|file',
            'reg_proof' => 'required|file',
            'major' => 'sometimes|max:50',
            'union_number' => 'sometimes|numeric'
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $this->clinic->registerClinic($request);
        return redirect('/dashboard/admin/allClinics');
    }

    public function getClinic($id)
    {
        return $this->clinic->getClinic($id);
    }

    public function updateClinic(Request $request)
    {
        $user = User::where('user_name',$request->old_user_name)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'email' => [
                'required','email','max:255',
                'unique:users,email,'.$user->user_name.',user_name'
            ],
            'password' => 'min:8|confirmed',
            'password_confirmation' => 'same:password',
            'gender' => 'required',
            'ADuName' => [
                'required','max:50',
                'unique:users,user_name,'.$user->user_name.',user_name'
            ],
            'phone' => 'required|phone',
            'role' => 'required',
            'address' => 'required|max:255',
            'clinic_phone' => 'required|phone',
            'clinic_address' => 'required|max:100',
            'clinic' => 'required|max:50',
            'image' => 'sometimes|image',
            'id_image' => 'sometimes|file',
            'reg_proof' => 'sometimes|file',
            'major' => 'sometimes|max:50',
            'union_number' => 'sometimes|numeric'
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

         $this->clinic->updateClinic($request);
         return redirect()->back();
    }

  
}
