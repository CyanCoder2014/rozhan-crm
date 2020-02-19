<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTablesForBusinessPlus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('personal_code')->nullable();
            $table->string('image')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('tell')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->text('location')->nullable();
            $table->string('post_code')->nullable();
            $table->string('national_code')->nullable();

            $table->bigInteger('type')->nullable();   // lead, opportunity, coworker, ....
            $table->bigInteger('state')->nullable();
            $table->bigInteger('status')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });



        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('personal_code')->nullable();
            $table->string('image')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('tell')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->text('location')->nullable();
            $table->string('post_code')->nullable();
            $table->string('national_code')->nullable();

            $table->bigInteger('type')->nullable();
            $table->bigInteger('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });



        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('service_categories')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('number')->nullable();
            $table->bigInteger('star')->nullable();  // 1-100

            $table->bigInteger('type')->nullable(); //
            $table->string('state')->nullable();
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
        Schema::dropIfExists('new_tables_for_business_plus');
    }
}
