<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->firstName,
        'image' => $faker->image(),
        'family' => $faker->lastName,
        'description' => $faker->text,
        'min_time' => $faker->numberBetween(0,100),
        'score' => $faker->numberBetween(0,10),
        'star' => $faker->numberBetween(0,5),
        'type' => null,
        'state' => null,
        'created_by' => null,
        'updated_by' => null,
    ];
});
