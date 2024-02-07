<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        

        User::create([
            'username'=>'user1',
            'password'=>bcrypt('user123'),
            'role'=>'admin',
            'name'=>'Admin',
            'email'=>'warriorsincognito@gmail.com',
            'phone'=>'876126',
            'role'=>'admin',
            'gender'=>"Male",
            'photo'=>"default.jpg",
            'status'=>false,

        ]);
        User::create([
            'username'=>'user2',
            'password'=>bcrypt('user123'),
            'role'=>'user',
            'name'=>'Xyz',
            'email'=>'xyz@gmail.com',
            'phone'=>'986126',
            'gender'=>"Male",
            'photo'=>"default.jpg",
            'status'=>false,

        ]);
        User::create([
            'username'=>'user3',
            'password'=>bcrypt('user123'),
            'role'=>'user',
            'name'=>'ABC',
            'email'=>'abc@gmail.com',
            'phone'=>'984146',
            'gender'=>"Male",
            'photo'=>"default.jpg",
            'status'=>false,

        ]);

        $faker= Faker::create();
        
        for($i=0;$i<5;$i++){    
            $user=new User();
            $uname=$faker->unique()->userName();
            $user->username=str_replace(".","",(str_replace(" ","",$uname)));
            $user->password=bcrypt($faker->password());
            $user->name=$faker->name();
            $user->email=$faker->unique()->email();
            $user->phone=$faker->phoneNumber();
            $user->role='user';
            $user->gender="Male";
            $user->photo="default.jpg";
            $user->status=false;
            $user->save();
        }
    }
}
