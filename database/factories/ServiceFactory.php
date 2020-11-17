<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'service_type_id' => rand(1, 5),
        'name' =>  $faker->sentence(2, true),
        'short_description' => $faker->sentence(10, true),
        'long_description' => $faker->sentence(20, true),
        'price' => $faker->numberBetween(10, 500),
        'images' => $faker->imageUrl(640, 480)
    ];
});