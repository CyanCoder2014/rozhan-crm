<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_gifts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('score_gift_id');
            $table->foreign('score_gift_id')->references('id')->on('score_gifts')->onDelete('cascade');
            $table->unsignedBigInteger('used_order_id')->nullable();
            $table->foreign('used_order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_gifts');
    }
}
