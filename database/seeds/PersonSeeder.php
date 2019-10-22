<?php

use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = factory(\App\Person::class)->make();
        $person->save();
        $personService = factory(\App\PersonService::class)->make();
        $person->services()->save($personService);
    }
}
