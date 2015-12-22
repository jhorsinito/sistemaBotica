<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumTikectsToFBnumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('FBnumbers', function (Blueprint $table) {
            $table->biginteger('numTiketFactura');
            $table->biginteger('numTiketBoleta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('FBnumbers', function (Blueprint $table) {
            //
        });
    }
}
