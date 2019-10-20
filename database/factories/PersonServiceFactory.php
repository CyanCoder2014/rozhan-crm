<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PersonService;
use Faker\Generator as Faker;

$factory->define(PersonService::class, function (Faker $faker) {
    return [
        'person_id' => 1,
        'service_id' => 1,
        'title' => $faker->name,
        'note' => $faker->text(100),
        'type' => null,
        'state' => null,
        'created_by' => null,
        'updated_by' => null,
        'deleted_on' => null,
    ];
});
