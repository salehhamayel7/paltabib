<?php 

namespace App\Services;

use App\Doctor;
use App\User;
use Image;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorService{

    public function createDoctor(Request $request)
    {
      
    	$doctor = new Doctor;
    	$user = new User;

    	$user->name = $request->get('ADName');
    	$user->user_name = $request->get('ADuName');
    	$user->email = $request->get('ADemail');
    	$user->address = $request->get('ADaddress');
    	$user->phone = $request->get('ADphone');
    	$user->gender = $request->get('ADgender');
    	$user->password = bcrypt($request->get('ADpass'));
    	$user->role = "Doctor";
      $user->clinic_id = Auth::user()->clinic_id;
      
      if($request->hasFile('ATimage')){
          $image = $request->file('ATimage');
          $imageName = $doctor->user_name.'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
          $user->image = $imageName;
      }
      
      $user->save();

      $doctor->id=$user->id;
      $doctor->user_name = $request->get('ADuName');
    	$doctor->union_number = $request->get('ADnumber');
    	$doctor->major = $request->get('ADmajor');
    	$doctor->salary = $request->get('ADsalary');
      $doctor->clinic_id = $request->get('ADclinic');
      $doctor->save();

    }

    public function getAllDoctors()
    {
      return Doctor::all();
    }
     public function getDoctorWithUserName($user_name)
    {
      return Doctor::where('user_name','=',$user_name)->first();
    }
    
      public function updateDoctorWithUserName(Request $request,$user_name)
	    {
        if(Auth::user()->role == 'Manager' || Auth::user()->role == 'Manager,Doctor' ){
                DB::table('doctors')
                    ->where('user_name', $user_name)
                    ->update(['salary' => $request->get('ADsalary')]);
            }

		 if(request()->has('ADpass')){
                DB::table('users')
                    ->where('user_name', $user_name)
                    ->update(['password' => bcrypt($request->get('ADpass'))]);
            }

      if($file = $request->file('id_image'))
      {
          $filename= str_random(50).'.'.$file->getClientOriginalExtension();
          Storage::disk('local')->put($filename,File::get($file));
          DB::table('users')
              ->where('user_name', $user_name)
              ->update([
                  'id_image' => $filename,
              ]);
      }

        if($request->hasFile('ATimage')){
            $user = User::where('user_name',$user_name)->first();
            $image = $request->file('ATimage');
            $imageName = $request->get('ADuName').'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
            $user->image = $imageName;
            $user->save();
        }

      DB::table('doctors')
      ->where('user_name',$user_name)
      ->update([
                'user_name'        => $request->get('ADuName'),
                'major'            => $request->get('ADmajor'),
                'union_number'     => $request->get('ADnumber'),
              ]);

                 
      DB::table('users')
      ->where('user_name',$user_name)
      ->update([
            'name'             => $request->get('ADName'),
            'email'            => $request->get('ADemail'),
            'user_name'        => $request->get('ADuName'),
            'phone'            => $request->get('ADphone'),
            'gender'           => $request->get('ADgender'),
            'address'          => $request->get('ADaddress'),
             ]);

        return redirect()->back();
	}


   public function changePicture(Request $request)
	    {
       
       if($request->hasFile('photo')){
               $image = $request->file('photo');
               $imageName = $request->user_name.'.'.$image->getClientOriginalExtension();
               Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
               DB::table('users')
                    ->where('user_name', '=' ,$request->user_name)
                    ->update(['image' => $imageName]);
            }
            return redirect()->back();
	}

  

    private function isTrue($status)
    {
        return $status == "on"? 1 : 0;
    }

   public function advanceSearch(array $data){
    
    $results = array();
    //protected $sql = "";
    if($data['name'] != "")
    {
      $sql = $sql."select * from pacients where user_name = ".$data['name']."";
       // $results["user_name"] = DB::table('pacient')->where('user_name',$data['name'])->get();
       // return $results->toArray();
    }
    if($data['from'] != "" && $data['to'] != "")
    {
       $sql = $sql." and age between ".$data['from']."and ".$data['to']."";
    }
    else if($data['from'] != "")
    {
      if($sql != "")
      $sql = $sql." and age >= ".$data['from']."";
    else
      $sql = $sql."select * from pacients where age >= ".$data['from']."";
        // $results['from'] = DB::table('user')->whereColumn([['role','=','pacient'],['age','>=',$data['from']]])->get()->toArray();
    }
    else if($data['to'] != "")
    {
    if($sql != "")
       $sql = $sql." and age <= ".$data['to']."";
else
      $sql = $sql."select * from pacients where age <= ".$data['to']."";

     

      // $results['to'] = DB::table('user')->whereColumn([['role','=','pacient'],['age','<=',$data['to']]])->get()->toArray();
      
    }
     if($data['job'] != "")
    {
      if($sql !="")
      $sql = $sql." and job = ".$data['job']."";
      else
        $sql = $sql."select * from pacients where job = ".$data['job']."";
    //   $results['job'] = DB::table('pacient')->where('job','=',$data['from'])->get()->toArray();
   }
    if($data['gender'] != "")
    {
      if($sql != "")
    $sql = $sql." and genfer = ".$data['gender']."";
  else
            $sql = $sql."select * from pacients where gender = ".$data['gender']."";

      // $results['gender'] = DB::table('user')->whereColumn([['role','=','pacient'],['gender','=',$data['gender']]])->get()->toArray();
    }
    if($data['address'] != "")
    {
      if($sql != "")
      $sql = $sql." and address = ".$data['address']."";
    else
            $sql = $sql."select * from pacients where address = ".$data['address']."";
        // $results['address'] = DB::table('user')->whereColumn([['role','=','pacient'],['address','=',$data['address']]])->get()->toArray();
    }
    if($data['treatment'] != "")
    {
      if($sql != "")
      $sql = $sql." and treatment = ".$data['treatment']."";
     else
            $sql = $sql."select * from pacients where treatment = ".$data['treatment']."";
      // $results['terminate'] = DB::table('pacient')->where('treatment','=',$data['treatment'])->get()->toArray();
    }
    if($data['otherDesiase'] != "")
    {
      if($sql != "")
      $sql = $sql." and allergic_from = ".$data['otherDesiase'].""; 
    else
            $sql = $sql."select * from pacients where allergic_from = ".$data['otherDesiase']."";
      // $results['otherDeseas'] = DB::table('pacient')->where('other',$data['otherDesiase'])->get()->toArray();
    }
     if($data['isMarried'] != "")
    {
       if($sql != "")
      $sql = $sql." and Marrid = ".$data['isMarried']."";
     else
            $sql = $sql."select * from pacients where Marrid = ".$data['isMarried']."";
       // $results['married'] = DB::table('pacient')->where('marriede',$data['isMarried'])->get()->toArray();
    }
    $paciens = DB::select($sql);
   /*$results['age'] = array_intersect($results['from'], $results['to']);
    $results['age_gender'] = array_intersect($results['age'], $results['gender']);
    $results['age_gender_desiase'] = array_intersect($results['age_gender'], $results['otherDeseas']);
    $results['age_gender_desiase_treatment'] = array_intersect($results['age_gender_desiase'], $results['terminate']);

    $results['age_gender_desiase_treatment_address'] = array_intersect($results['age_gender_desiase_treatment'], $results['address']);

     $results['age_gender_desiase_treatment_address_married'] = array_intersect($results['age_gender_desiase_treatment_address'], $results['married']);

     $finalResult['result'] =  $results['age_gender_desiase_treatment_address_married'];

     return $finalResult;
*/
         return $pacients;
    }

      

}