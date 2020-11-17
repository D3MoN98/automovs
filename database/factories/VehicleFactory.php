<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'brand' => $faker->sentence(1, true),
        'model' => $faker->sentence(1, true),
        'variant' => $faker->sentence(2, true),
        'registration_number' =>  $faker->md5,
        'type' => $faker->randomElement(['2-wheeler', '4-wheeler']),
        'driven' => rand(1, 25),
        'color' => $faker->randomElement(['red', 'black', 'white', 'green', 'blue', 'grey', 'yellow', 'violet']),
        'year_bought' => $faker->year,
        'insurance' => $faker->year,
        'location' => rand(1, 10),
        'price' => $faker->numberBetween(10, 500),
        'images' => $faker->imageUrl(640, 480)
    ];
});