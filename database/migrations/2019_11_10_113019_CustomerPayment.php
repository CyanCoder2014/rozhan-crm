<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_payments', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('number')->nullable();
            $table->string('reason')->nullable();
            $table->string('buyer')->nullable();
            $table->string('receive_state')->nullable();
            $table->string('period')->nullable();
            $table->string('pay_state')->nullable();
            $table->dateTime('register_date')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->unsignedBigInteger('account')->nullable();
            $table->string('contract_number')->nullable();
            $table->unsignedMediumInteger('bank')->nullable();
            $table->string('bank_calculate')->nullable();
            $table->string('cheque_number')->nullable();
            $table->unsignedSmallInteger('term')->nullable();
            $table->string('payment_account')->nullable();
            $table->unsignedBigInteger('payed')->nullable();
            $table->unsignedTinyInteger('type')->nullable();
            $table->string('finance_state')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('state')->nullable();
            $table->bigInteger('status')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('customer_payments');
    }
}
