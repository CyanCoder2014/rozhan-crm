<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventRegister extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable()->reference('id')->on('users')->onDelete('set null');
            $table->unsignedInteger('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->smallInteger('status');
            $table->smallInteger('quantity');
            $table->unsignedInteger('price');
            $table->unsignedInteger('payment_id')->nullable();
            $table->string('tracking_code');
            $table->timestamps();
//            $table->foreign('user_id')->reference('id')->on('users')->onDelete('set null');
//            $table->foreign('event_id')->reference('id')->on('events')->onDelete('cascade');
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
