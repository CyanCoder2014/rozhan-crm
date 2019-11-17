<?php

use Illuminate\Database\Seeder;

class SuperAdministratorSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin =\App\Role::where('name','superadministrator')->first();
        if (!$superAdmin)
            $superAdmin = \App\Role::create(['name' =>'superadministrator']);
        $superAdmin->syncPermissions(\App\Permission::all());
    }
}
