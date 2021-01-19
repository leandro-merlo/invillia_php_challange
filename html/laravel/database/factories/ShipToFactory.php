<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShipTo;
use Faker\Generator as Faker;

$factory->define(ShipTo::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'city' => $faker->city,
        'country' => $faker->country
    ];
});
