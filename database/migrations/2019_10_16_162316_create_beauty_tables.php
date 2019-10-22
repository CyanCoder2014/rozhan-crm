<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeautyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });



        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->string('age')->nullable();
            $table->string('major')->nullable();
            $table->string('education_field')->nullable();
            $table->string('work_field')->nullable();
            $table->string('national_code')->nullable();
            $table->string('gender')->nullable();
            $table->date('birth')->nullable();
            $table->text('about')->nullable();
            $table->text('visitor_note')->nullable();

            $table->bigInteger('type')->nullable();
            $table->bigInteger('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });



        Schema::create('networks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('link')->nullable();

            $table->bigInteger('type')->nullable();   // web, social media, ...
            $table->bigInteger('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });



        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('number')->nullable();
            $table->string('percent')->nullable();

            $table->string('type')->nullable(); //  fields
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });



        Schema::create('special_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->dateTime('special_date')->nullable();
            $table->string('percent')->nullable();

            $table->bigInteger('type')->nullable(); //  engaged date, birthday, ...;
            $table->bigInteger('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });


        Schema::create('fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('estimated_number')->nullable();
            $table->bigInteger('predicted_number')->nullable();
            $table->bigInteger('final_number')->nullable();
            $table->string('percent')->nullable();

            $table->string('type')->nullable(); //  fields
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });




        Schema::create('service_categories', function (Blueprint $table) {
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
            $table->dateTime('deleted_on')->nullable();
        });



        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('services')->onDelete('cascade');
            $table->bigInteger('service_categories_id')->unsigned();
            $table->foreign('service_categories_id')->references('id')->on('service_categories')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('initial_number')->nullable();
            $table->bigInteger('remaining_number')->nullable();
            $table->bigInteger('blocked_number')->nullable();
            $table->bigInteger('reserved')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('predicted_price')->nullable();
            $table->bigInteger('default_discount')->nullable();
            $table->bigInteger('tax')->nullable();
            $table->bigInteger('min_time')->nullable(); // min
            $table->bigInteger('max_time')->nullable(); // min
            $table->bigInteger('star')->nullable();  // 1-100

            $table->string('type')->nullable(); //
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });






        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('star')->nullable();  // 1-100

            $table->bigInteger('type')->nullable(); //
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });



        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger('product_category_id')->unsigned();
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->string('unit')->nullable();
            $table->bigInteger('initial_amount')->nullable();
            $table->bigInteger('remaining_number')->nullable();
            $table->bigInteger('blocked_number')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('predicted_price')->nullable();
            $table->bigInteger('default_discount')->nullable();
            $table->bigInteger('tax')->nullable();
            $table->bigInteger('min_time')->nullable(); // min
            $table->bigInteger('max_time')->nullable(); // min
            $table->bigInteger('star')->nullable();  // 1-100

            $table->string('type')->nullable(); //
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });



        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('family')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('min_time')->nullable(); //
            $table->bigInteger('score')->nullable(); //
            $table->bigInteger('star')->nullable();  //

            $table->string('type')->nullable(); //
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });


        Schema::create('person_timings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');

            $table->string('title')->nullable();
            $table->string('description')->nullable();

            $table->date('date')->nullable(); //
            $table->time('start')->nullable(); //
            $table->time('end')->nullable();  //

            $table->string('type')->nullable(); //
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });




        Schema::create('person_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('note')->nullable();

            $table->string('type')->nullable(); //
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });




        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('note')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('predicted_price')->nullable();
            $table->bigInteger('default_discount')->nullable();
            $table->bigInteger('min_time')->nullable(); // min
            $table->bigInteger('max_time')->nullable(); // min
            $table->bigInteger('star')->nullable();  // 1-100

            $table->string('type')->nullable(); //
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });



        Schema::create('packages_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->string('note')->nullable();
            $table->bigInteger('discount')->nullable();

            $table->string('type')->nullable(); //
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });



        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->bigInteger('service_id')->unsigned();
//            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('file')->nullable();
            $table->bigInteger('general_price')->nullable();
            $table->bigInteger('general_discount')->nullable();
            $table->bigInteger('general_tax')->nullable();
            $table->bigInteger('final_price')->nullable();
            $table->date('general_date')->nullable(); //
            $table->time('general_start')->nullable(); //
            $table->time('general_end')->nullable();  //

            $table->string('type')->nullable(); // request, order, payment
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });


        Schema::create('order_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->bigInteger('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->string('note')->nullable();
            $table->bigInteger('number')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('discount')->nullable();
            $table->bigInteger('tax')->nullable();
            $table->date('date')->nullable(); //
            $table->time('start')->nullable(); //
            $table->time('end')->nullable();  //

            $table->string('type')->nullable(); //
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });




        Schema::create('orders_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('note')->nullable();
            $table->bigInteger('unit')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('discount')->nullable();
            $table->bigInteger('tax')->nullable();
            $table->date('date')->nullable(); //
            $table->time('start')->nullable(); //
            $table->time('end')->nullable();  //

            $table->string('type')->nullable(); //
            $table->string('state')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('deleted_on')->nullable();
        });





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('beauty_tables');

    }
}
