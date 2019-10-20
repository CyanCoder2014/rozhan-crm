<?php

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Spatie\Permission\Models\Role::findOrCreate('SuperAdmin','web');
        $superAdmin = \App\User::find(1);
        if ($superAdmin && !$superAdmin->hasRole('SuperAdmin'))
            $superAdmin->assignRole('SuperAdmin');
        \Spatie\Permission\Models\Role::findByName('SuperAdmin')->syncPermissions(\Spatie\Permission\Models\Permission::all());
    }
}
