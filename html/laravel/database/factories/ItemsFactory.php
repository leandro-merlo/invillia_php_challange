<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'note' => $faker->word,
        'quantity' => rand(1, 1000),
        'price' => $faker->randomFloat(2, 1, 500)
    ];
});
