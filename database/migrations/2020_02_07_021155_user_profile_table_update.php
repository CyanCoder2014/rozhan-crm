<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserProfileTableUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {


            $table->string('regent')->nullable();
            $table->string('reagent_detail')->nullable();
            $table->string('reagent_state')->nullable();
            $table->string('reagent_page')->nullable();
            $table->string('reagent_site')->nullable();
            $table->string('reagent_type')->nullable();
            $table->unsignedBigInteger('regent_id')->nullable();
            $table->foreign('regent_id')->references('id')->on('contacts')->onDelete('cascade');


            $table->string('weight')->nullable();
            $table->string('height')->nullable();

            $table->string('disease')->nullable();
            $table->string('drug')->nullable();
            $table->string('heart')->nullable();
            $table->string('respiratory')->nullable();
            $table->string('Liver')->nullable();
            $table->string('Diabetes')->nullable();
            $table->string('Seizure')->nullable();
            $table->string('infectiousdisease')->nullable();
            $table->string('tumor')->nullable();
            $table->string('asthma')->nullable();
            $table->string('hormonaldisorder')->nullable();
            $table->string('otherHerpes')->nullable();
            $table->string('asprin')->nullable();
            $table->string('deyper')->nullable();
            $table->string('convulsion')->nullable();
            $table->string('arpharin')->nullable();
            $table->string('heparin')->nullable();
            $table->string('minoxide')->nullable();
            $table->string('rakuten')->nullable();
            $table->string('cream')->nullable();
            $table->string('otherpharmacy')->nullable();
            $table->string('boronz')->nullable();
            $table->string('surgery')->nullable();
            $table->string('typeSurgery')->nullable();
            $table->string('getpregnant')->nullable();
            $table->string('milch')->nullable();
            $table->string('Botox')->nullable();
            $table->string('zhel')->nullable();

            $table->string('text')->nullable();





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
