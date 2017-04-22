<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docVentas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('detalleCaja_id')->unsigned();
            $table->integer('venta_id')->unsigned();
            $table->integer('pagoVenta_id')->unsigned();
            $table->foreign('detalleCaja_id')->references('id')->on('detalleCajas');
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->foreign('pagoVenta_id')->references('id')->on('pagoVentas');
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
        Schema::drop('docVentas');
    }
}