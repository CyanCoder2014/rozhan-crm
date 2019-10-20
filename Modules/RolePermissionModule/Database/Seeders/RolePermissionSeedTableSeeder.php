<?php

namespace Modules\RolePermissionModule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class RolePermissionSeedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Permission::insert([
            [
                'guard_name' => 'web',
                'name'=> 'افزودن مدیر سایت'
            ],
            [
                'guard_name' => 'web',
                'name'=> 'ویرایش مدیر سایت'
            ],
            [
                'guard_name' => 'web',
                'name'=> 'افزودن نقش های مدیران سایت'
            ],
            [
                'guard_name' => 'web',
                'name'=> 'ویرایش نقش های مدیران سایت'
            ],
            [
                'guard_name' => 'web',
                'name'=> 'حذف نقش های مدیران سایت'
            ],
        ]);
    }
}
