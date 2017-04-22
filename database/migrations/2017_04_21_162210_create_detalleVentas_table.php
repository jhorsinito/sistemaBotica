<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleVentas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad')->nullable();
            $table->string('descripcion')->nullable();
            $table->decimal('precioUnitario', 10, 2);
            $table->decimal('precioVenta', 10, 2);
            $table->decimal('total', 10, 2);
            $table->integer('venta_id')->unsigned()->nullable();
            $table->integer('detPre_id')->unsigned()->nullable();
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->foreign('detPre_id')->references('id')->on('detPres');
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
        Schema::drop('detVentas');
    }
}