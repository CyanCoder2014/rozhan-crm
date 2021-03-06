<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(PermissionSeeds2::class);
        // $this->call(OrderPaymentCompleted::class);
        $this->call(SuperAdministratorSeed::class);
        $this->call(AdminSeeder::class);
    }
}
