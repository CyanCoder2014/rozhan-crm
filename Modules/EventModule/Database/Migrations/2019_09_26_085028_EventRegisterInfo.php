<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventRegisterInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_register_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_register_id')->reference('id')->on('event_registers')->onDelete('cascade');
            $table->unsignedTinyInteger('status');
            $table->string('name');
            $table->string('national_code');
            $table->timestamps();
//            $table->foreign('event_register_id')->reference('id')->on('event_registers')->onDelete('cascade');
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
