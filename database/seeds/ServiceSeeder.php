<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serviceCategory = factory(App\ServiceCategory::class)->make();
        $serviceCategory->save();
        $service = factory(App\Service::class)->make();
        $service->save();

    }
}
