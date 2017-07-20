<?php 

namespace App\Services;
use App\Secretaries;
use App\User;
use Image;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SecretaryService{

	public function createSercretary(Request $request)
	{
		$secretaries = new Secretaries;
		$user = new User;

		$user->name = $request->get('ADName');

    	$user->user_name = $request->get('ADuName');
    	$user->email = $request->get('ADemail');
    	$user->address = $request->get('ADaddress');
    	$user->phone = $request->get('ADphone');
    	$user->gender = $request->get('ADgender');
    	$user->password = bcrypt($request->get('ADpass'));
    	$user->role = 'Secretary';
        $user->clinic_id = Auth::user()->clinic_id;
        
        if($request->hasFile('ATimage')){
            $image = $request->file('ATimage');
            $imageName = $user->user_name.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
            $user->image = $imageName;
        }

       $user->save();

        $secretaries->id = $user->id;
    	$secretaries->user_name = $request->get('ADuName');
    	$secretaries->salary = $request->get('ADsalary');

      
       $secretaries->save();

	}

    public function getAllSecretaries()
    {
      return Secretaries::all();
    }

   public function getSecretaryWithUserName($user_name)
    {
      return Secretaries::where('user_name','=',$user_name)->first();
    }
      public function updateSecretaryWithUserName(Request $request,$user_name)
    {

        if(Auth::user()->role == 'Manager' || Auth::user()->role == 'Manager,Doctor' ){
                DB::table('secretaries')
                    ->where('user_name', $user_name)
                    ->update(['salary' => $request->get('ADsalary')]);
            }
      
		 if(request()->has('ADpass')){
                DB::table('users')
                    ->where('user_name', $user_name)
                    ->update(['password' => bcrypt($request->get('ADpass'))]);
            }
        
        DB::table('secretaries')
        ->where('user_name',$user_name)
        ->update([
                    'user_name' => $request->get('ADuName'),
                ]);
        
        

        if($request->hasFile('ATimage')){
            $user = User::where('user_name',$user_name)->first();
            $image = $request->file('ATimage');
            $imageName = $request->get('ADuName').'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path("images\\users\\". $imageName));
            $user->image = $imageName;
            $user->save();
        }
        
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
}
