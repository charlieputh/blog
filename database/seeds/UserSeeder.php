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

        //Normal User 0 is admin 1 is normal
        User::create([
            'uid' => '2014402',
            'name' => 'charlie1',
            'type' => '1',
            'password' => bcrypt('a137988166'),
        ]);
        //admin
//        User::create([
//            'uid'=>'20142',
//            'name'=>'teacher',
//            'type'=>'0',
//            'password'=>bcrypt('123456'),
//        ]);
    }
}


