<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserRole;
use App\Role;
use App\Service;
use App\ServiceType;
use App\Vehicle;
use Illuminate\Support\Facades\Hash;

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
        if (Role::count() === 0) {
            $roles = ['admin', 'customer'];
            foreach ($roles as $key) {
                Role::create([
                    'name' => $key
                ]);
            }
        }

        if (is_null(User::find(1))) {

            $admin = User::create([
                'name' => 'admin',
                'email' => 'sjgalaxy98@gmail.com',
                'contact_no' => '6291839827',
                'address' => '23/4B Banamali Nasker Road',
                'password' => Hash::make('password')
            ]);

            $admin->roles()->save(Role::find(1));
        }


        factory(User::class, 5)->create()->each(function ($user) {
            $role = 2;
            $user->roles()->save(Role::find($role));

            $user->vehicles()->createMany(factory(Vehicle::class, rand(1, 3))->make()->toArray());
        });

        if (ServiceType::count() === 0) {
            factory(ServiceType::class, 5)->create()->each(function ($service_type) {
                $service_type->services()->createMany(factory(Service::class, rand(3, 5))->make()->toArray());
            });
        }
    }
}