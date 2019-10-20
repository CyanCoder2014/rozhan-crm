<?php

namespace Modules\TicketingModule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class TicketingModuleDatabaseSeeder extends Seeder
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
                'name'=> 'افزودن تیکت'
            ],
            [
                'guard_name' => 'web',
                'name'=> 'پاسخ به تیکت'
            ],
            [
                'guard_name' => 'web',
                'name'=> 'نمایش پاسخ تیکت'
            ],
            [
                'guard_name' => 'web',
                'name'=> 'حذف تیکت'
            ],
            [
                'guard_name' => 'web',
                'name'=> 'افزودن دسته بندی تیکت'
            ],
            [
                'guard_name' => 'web',
                'name'=> 'ویرایش دسته بندی تیکت'
            ],
            [
                'guard_name' => 'web',
                'name'=> 'حذف دسته بندی تیکت'
            ],
        ]);
        // $this->call("OthersTableSeeder");
    }
}
