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
        //
        User::create([
        	'name' => 'cristian trujillo',
            'email' => 'crisfalt@gmail.com',
            'password' => bcrypt('crisfalt'),
            'username' => 'crisfalt',
            'admin' => true
        ]);
        User::create([
        	'name' => 'kevin torres',
            'email' => 'nearriver1995@gmail.com',
            'password' => bcrypt('123123'),
            'username' => 'kevin',
            'admin' => true
        ]);
    }
}
