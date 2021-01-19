<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    $phones = [
        "11111111",
        "22222222",
        "33333333",
        "44444444",
        "55555555",
        "66666666",
        "77777777",
        "88888888",
        "99999999",
        "00000000",
    ];
    return [
        'name' => $faker->name(),
        'phones' => $faker->randomElements($phones, rand(1, 3), false)
    ];
});
