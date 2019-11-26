<?php

use Illuminate\Database\Seeder;

class OrderPaymentCompleted extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //orders.payed
        \App\Permission::insert([
            [
                'name' =>'orders.payed',
                'display_name' =>'ایجاد سند پرداخت برای سفارش',
                'description' =>'',
            ]]);
    }
}
