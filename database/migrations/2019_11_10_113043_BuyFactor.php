<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuyFactor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_factors', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_description')->nullable();
            $table->unsignedMediumInteger('numbers')->nullable();
            $table->string('unit')->nullable();
            $table->unsignedBigInteger('unit_price')->nullable();
            $table->unsignedSmallInteger('discount')->nullable();
            $table->unsignedBigInteger('final_price')->nullable();
            $table->dateTime('factor_date')->nullable();
            $table->unsignedSmallInteger('tax')->nullable();
            $table->unsignedBigInteger('price_plus_tax')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->string('buy_type')->nullable();
            $table->string('description')->nullable();
            $table->string('full_name')->nullable();
            $table->string('national_code')->nullable();
            $table->string('register_number')->nullable();
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('tell_number')->nullable();
            $table->string('economic_code')->nullable();
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
        Schema::dropIfExists('buy_factors');
    }
}
