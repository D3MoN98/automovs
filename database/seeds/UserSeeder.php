<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserRole;
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
        $user_id = User::create([
            'name' => 'Sudipta Jana',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ])->id;

        UserRole::create([
            'user_id' => $user_id,
            'role_id' => 2,
        ]);
    }
}
