<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetComercialGenericoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detComercialGenerico', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('productoComercial_id')->unsigned();
            $table->integer('productoGenerico_id')->unsigned();
            $table->foreign('productoComercial_id')->references('id')->on('products');
            $table->foreign('productoGenerico_id')->references('id')->on('products');
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
        Schema::drop('detComercialGenerico');
    }
}