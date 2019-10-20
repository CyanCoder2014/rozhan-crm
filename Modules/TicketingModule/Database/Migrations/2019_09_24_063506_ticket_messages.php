<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('owner_id')->index()->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('ticket_id')->index()->references('id')->on('tickets')->onDelete('cascade');
            $table->unsignedInteger('reply_to')->nullable()->references('id')->on('ticket_messages')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('ticket_messages');
    }
}
