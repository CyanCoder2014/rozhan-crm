<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ServiceCategory::class, function (Faker $faker) {
    return [
        'parent_id' => null,
        'title' => $faker->name,
        'image' => $faker->image(),
        'description' => $faker->text,
        'number' => $faker->phoneNumber,
        'star' => null,
        'type' => null,
        'state' => null,
        'created_by' => null,
        'updated_by' => null,
        'deleted_on' => null,
    ];
});
