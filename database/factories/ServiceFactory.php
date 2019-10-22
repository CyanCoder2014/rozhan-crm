<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'parent_id' => null,
        'service_categories_id' => 1,
        'title' => $faker->name,
        'image' => $faker->image(),
        'description' => $faker->text,
        'initial_number' => null,
        'remaining_number' => null,
        'blocked_number' => null,
        'reserved' => null,
        'price' => $faker->numberBetween(1000,10000000),
        'predicted_price' => $faker->numberBetween(1000,10000000),
        'default_discount' => $faker->numberBetween(0,100),
        'tax' => $faker->numberBetween(0,100),
        'min_time' => $faker->numberBetween(5,240),
        'max_time' => $faker->numberBetween(5,240),
        'type' => null,
        'star' => null,
        'state' => null,
        'created_by' => null,
        'updated_by' => null,
        'deleted_on' => null
    ];
});
