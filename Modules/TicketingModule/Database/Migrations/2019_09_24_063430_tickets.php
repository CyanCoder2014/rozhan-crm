<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('owner_id')->index()->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('answerable_id')->nullable()->index()->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('category_id')->index()->references('id')->on('users')->onDelete('ticket_categories');
            $table->boolean('active');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
