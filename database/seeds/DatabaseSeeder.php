<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Clinic;
use App\Doctor;
use App\Pacient;
use App\Secretaries;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		$faker = Faker::create();
       	$user = new User();
		$user->name = "Saleh Hamayel";
		$user->email = "admin@gmail.com";
		$user->gender = "Male";
		$user->user_name = "11315084";
		$user->role = "Admin";
		$user->phone = $faker->e164PhoneNumber;
		$user->address = $faker->address;
		$user->password = bcrypt('passpass');
		$user->save();

		$current_time = Carbon::now()->toDateTimeString();

		for($i=0;$i<3;$i++){
			DB::table('sliders')->insert([
				'title' => "title ".$i,
				'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
				'image' => 'http://lorempixel.com/1000/300/abstract/qwe'.$i,
				'updated_at' => $current_time
			]);
		}

		for($i=0;$i<3;$i++){
			DB::table('sections')->insert([
				'title' => "title ".$i,
				'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
				'image' => 'http://lorempixel.com/500/500/abstract/qwe'.$i,
				'updated_at' => $current_time
			]);
		}

		for($i=0;$i<3;$i++){
			if($i == 0){
				$method = "per month";
				$type = "Basic";
			}
			else if($i == 1){
				$method = "per year";
				$type = "Plus";
				
			}
			else{
				$method = "6 months package";
				$type = "Ultra";
			}
			DB::table('payment_methods')->insert([
				'type' => $type,
				'price' => ($i+1)*5*$i,
				'description1' => 'Cras justo odio',
				'description2' => 'Cras justo odio',
				'description3' => 'Cras justo odio',
				'description4' => 'Cras justo odio',
				'description5' => 'Cras justo odio',
				'method' => $method,
			]);
		}

    }
}
