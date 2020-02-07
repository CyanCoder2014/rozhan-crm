<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->string('product_title')->nullable();
            $table->string('product_brand')->nullable();
            $table->string('product_guaranty')->nullable();
            $table->string('product_collection')->nullable();
            $table->string('product_serial')->nullable();
            $table->string('product_reference')->nullable();
            $table->string('product_state')->nullable();
            $table->string('deliver_date')->nullable();

            $table->string('history')->nullable();
            $table->string('note')->nullable();
            $table->string('guaranty')->nullable();
            $table->string('order_state')->nullable();
            $table->string('done_date')->nullable();
            $table->string('introduction')->nullable();
            $table->string('text')->nullable();





        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
