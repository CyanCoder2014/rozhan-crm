<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Events extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('owner_id')->reference('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
//            $table->text('images')->nullable();
            $table->unsignedInteger('category_id')->nullable()->reference('id')->on('event_categories')->onDelete('set null');
//            $table->smallInteger('genre');
//            $table->smallInteger('age_from');
//            $table->smallInteger('age_to')->nullable();
//            $table->smallInteger('type');
//            $table->smallInteger('difficulty');
            $table->unsignedInteger('capacity');
            $table->unsignedTinyInteger('quantity_limit');
            $table->unsignedInteger('price')->unsigned();
            $table->unsignedInteger('province_id');
            $table->unsignedInteger('city_id');
            $table->text('address');
            $table->float('lat',10,6)->nullable();
            $table->float('lng',10,6)->nullable();
            $table->timestamp('event_start_at');
            $table->timestamp('event_end_at');
            $table->timestamp('start_registration');
            $table->timestamp('end_registration');
            $table->smallInteger('status');
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
        //
    }
}
