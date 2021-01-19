<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use App\Models\Person;
use App\Models\ShipOrder;
use App\Models\ShipTo;
use Faker\Generator as Faker;

$factory->define(ShipOrder::class, function (Faker $faker) {
    return [
        'person_id' => factory(Person::class)->create()->id,
        'ship_to_id' => factory(ShipTo::class)->create()->id,
    ];
});
