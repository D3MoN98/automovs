<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserRole;
use App\Role;
// use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user_id = User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('password'),
        // ])->id;

        Role::create([
            'name' => 'admin',
        ]);

        UserRole::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
