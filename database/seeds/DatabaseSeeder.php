<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Clinic;
use App\Doctor;
use App\Pacient;
use App\secretaries;

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

                $clinic = new Clinic();
	            $clinic->name = $faker->name;
	            $clinic->manager_id = "11315084";
	            $clinic->phone = $faker->e164PhoneNumber;
                $clinic->address = $faker->address;
	            $clinic->save();

                DB::table('receipts')->insert([
                   'clinic_id' => $clinic->id,
                ]);

				$user = new User();
	            $user->name = $faker->name;
	            $user->email = "admin@gmail.com";
	            $user->gender = "Male";
	            $user->user_name = "11315080";
	            $user->role = "Admin";
	            $user->phone = $faker->e164PhoneNumber;
                $user->address = $faker->address;
                $user->image = "11315084.jpg";
	            $user->password = bcrypt('passpass');
	            $user->save();

				$user = new User();
	            $user->name = $faker->name;
	            $user->email = "manager@gmail.com";
	            $user->gender = "Male";
	            $user->user_name = "11315084";
	            $user->role = "Manager";
                $user->clinic_id = $clinic->id;
	            $user->phone = $faker->e164PhoneNumber;
                $user->address = $faker->address;
                $user->image = "11315084.jpg";
	            $user->password = bcrypt('passpass');
	            $user->save();

				$user = new User();
	            $user->name = $faker->name;
	            $user->email = "managerD@gmail.com";
	            $user->gender = "Male";
	            $user->user_name = "11315083";
	            $user->role = "Manager,Doctor";
                $user->clinic_id = $clinic->id;
	            $user->phone = $faker->e164PhoneNumber;
                $user->address = $faker->address;
                $user->image = "11315084.jpg";
	            $user->password = bcrypt('passpass');
	            $user->save();

				$doctor = new Doctor;
				$doctor->user_name = "11315083";
				$doctor->union_number = 31254367;
				$doctor->major = "GS";
				$doctor->salary = 0;
				$doctor->clinic_id = $clinic->id;
				$doctor->save();
				
                $user = new User();
	            $user->name = $faker->name;
	            $user->email = "doctor@gmail.com";
	            $user->gender = "Male";
	            $user->user_name = "11315085";
	            $user->role = "Doctor";
                $user->clinic_id = $clinic->id;
	            $user->phone = $faker->e164PhoneNumber;
                $user->address = $faker->address;
	            $user->password = bcrypt('passpass');
	            $user->save();

                $doctor = new Doctor();
	            $doctor->user_name = "11315085";
	            $doctor->clinic_id = $clinic->id;
	            $doctor->save();

                $user = new User();
	            $user->name = $faker->name;
	            $user->email = "pacient@gmail.com";
	            $user->gender = "Male";
	            $user->user_name = "11315086";
	            $user->role = "Pacient";
	            $user->phone = $faker->e164PhoneNumber;
                $user->address = $faker->address;
	            $user->password = bcrypt('passpass');
	            $user->save();

                $pacient = new Pacient();
	            $pacient->user_name = "11315086";
	            $pacient->save();


				$user = new User();
	            $user->name = $faker->name;
	            $user->email = "secretary@gmail.com";
	            $user->gender = "Male";
	            $user->user_name = "11315087";
	            $user->role = "Secretary";
				$user->clinic_id = $clinic->id;
	            $user->phone = $faker->e164PhoneNumber;
                $user->address = $faker->address;
	            $user->password = bcrypt('passpass');
	            $user->save();

                $pacient = new secretaries();
	            $pacient->user_name = "11315087";
	            $pacient->save();

				DB::table('patient_clinic')->insert([
                   'clinic_id' => $clinic->id,
				   'patient_id' => "11315086",
                ]);
               

    }
}
