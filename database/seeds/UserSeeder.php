<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Generate 2 kinds of uers

//        // 0 is super admin
//        User::create([
//            'uid'=>'20142',
//            'name'=>'teacher',
//            'type'=>'0',
//            'password'=>bcrypt('123456'),
//        ]);
//
//        // 1 is nomal teacher
//        User::create([
//            'uid' => '2014402',
//            'name' => 'charlie1',
//            'type' => '1',
//            'password' => bcrypt('a137988166'),
//        ]);
        // 2 is student without authentications
//        User::create([
//            'uid' => '2014401',
//            'name' => 'student_test',
//            'type' => '2',
//            'password' => bcrypt('123456'),
//        ]);


    }
}


