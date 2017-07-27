<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClinicService;

class ClinicController extends Controller
{
    //
    protected $clinic;
	public function __construct(ClinicService $clinic)
	{
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
         $this->clinic->registerClinic($request);
         return redirect('/dashboard/admin/allClinics');
    }

    public function getClinic($id)
    {
        return $this->clinic->getClinic($id);
    }

    public function updateClinic(Request $request)
    {
         $this->clinic->updateClinic($request);
         return redirect()->back();
    }

  
}
