<?php

namespace Database\Seeders;

use App\Models\AppointmentSlot;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $doctors = [
            [
                'name' => 'Bill',
                'surname' => 'Potter',
                'Dob' => '25/4/1984',
                'Gender' => 'M',
                'Email' => 'bill.potter@yahoo.com',
                'MobNo' => '7568439750',
                'Address' => '75 Oval road'
            ],
            [
                'name' => 'Enki',
                'surname' => 'Soul',
                'Dob' => '9/8/1983',
                'Gender' => 'F',
                'Email' => 'enkisoul34@gmail.com',
                'MobNo' => '7343048853',
                'Address' => '74 hippo street'
            ],
            [
                'name' => 'Alexi',
                'surname' => 'Ntoul',
                'Dob' => '6/9/1987',
                'Gender' => 'M',
                'Email' => 'alexintoul45@gmail.com',
                'MobNo' => '7345738924',
                'Address' => '84  Health road'
            ],
            [
                'name' => 'Carlos',
                'surname' => 'Diego',
                'Dob' => '7/9/1970',
                'Gender' => 'M',
                'Email' => 'carlosdiego@gmail.com',
                'MobNo' => '7408544498',
                'Address' => '6 maver street'
            ],
            [
                'name' => 'Maria',
                'surname' => 'Selman',
                'Dob' => '5/8/1956',
                'Gender' => 'F',
                'Email' => 'mariaselman@gmail.com',
                'MobNo' => '7463894372',
                'Address' => '4 bolton road'
            ]
        ];

        foreach($doctors as $doctor) {
            $staff = new Staff();
            $staff->name = $doctor['name'];
            $staff->surname = $doctor['surname'];
            $staff->Dob = $doctor['Dob'];
            $staff->Gender = $doctor['Gender'];
            $staff->Email = $doctor['Email'];
            $staff->MobNo = $doctor['MobNo'];
            $staff->Address = $doctor['Address'];
            $staff->save();
        }

    }
}
