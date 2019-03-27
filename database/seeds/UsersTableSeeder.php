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
            'first_name'=>'Fred',
            'last_name'=>'Clinton',
            'email'=>'clinton@enshika.com',
            'password' => 'admin',
            'remember_token' => str_random(10),

        ]);
    }
}
