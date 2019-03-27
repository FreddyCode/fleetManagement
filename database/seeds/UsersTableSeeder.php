<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'=>'Enshika',
            'last_name'=>'Admin',
            'email'=>'admin@enshika.com',
            'password' => 'admin',
            'remember_token' => str_random(10),

        ]);
    }
}
