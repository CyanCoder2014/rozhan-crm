<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoAccountIdToSpecialDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('special_dates', function (Blueprint $table) {
            $table->unsignedBigInteger('co_account_id')->after('id')->nullable();
            $table->foreign('co_account_id')
                  ->references('id')
                  ->on('cooperation_accounts')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('special_dates', function (Blueprint $table) {
            $table->dropForeign($table->getTable() . '_co_account_id_foreign');
            $table->dropColumn('co_account_id');
        });
    }
}
