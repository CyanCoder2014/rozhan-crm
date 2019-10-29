<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         *              "messageid"
                        "message",
                        "status",
                        "statustext",
                        "sender",
                        "receptor",
                        "date" ,
                        "cost",
                        "user_id"
         */
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('messageid')->nullable();
            $table->string('message')->nullable();
            $table->string('status')->nullable();
            $table->string('statustext')->nullable();
            $table->string('sender')->nullable();
            $table->string('receptor')->nullable();
            $table->string('date')->nullable();
            $table->string('cost')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_logs');
    }
}
