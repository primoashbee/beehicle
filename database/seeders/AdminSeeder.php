<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('type', USER::ADMIN)->forceDelete();
        User::updateOrCreate([
            'name'=>'Administrator',
            'birthday'=>'1994-11-26',
            'gender'=>'male',
            'phone_number'=>'09091234321',
            'address'=>'Admin Street',
            'email'=>'admin@beehicle.xyz',
            'password'=> Hash::make('graduate0707'),
            'type' => User::ADMIN
        ]);
    }
}
