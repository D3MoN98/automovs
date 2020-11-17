<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ServiceType;
use Faker\Generator as Faker;

$factory->define(ServiceType::class, function (Faker $faker) {
    return [
        'name' =>  $faker->sentence(2, true),
        'description' => $faker->sentence(10, true),
    ];
});