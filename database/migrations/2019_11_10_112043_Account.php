<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Account extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('number')->nullable();
            $table->string('details')->nullable();
            $table->unsignedBigInteger('debt')->nullable();
            $table->unsignedBigInteger('credit')->nullable();
            $table->unsignedBigInteger('collecting_balance')->nullable();
            $table->unsignedBigInteger('balance')->nullable();
            $table->unsignedMediumInteger('bank')->nullable();
            $table->string('sheba')->nullable();
            $table->bigInteger('state')->nullable();
            $table->bigInteger('status')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('accounts');
    }
}
