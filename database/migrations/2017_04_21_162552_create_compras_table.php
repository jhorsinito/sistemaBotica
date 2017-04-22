<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proveedor_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('metodoPago_id')->unsigned();
            $table->integer('comprobante_id')->unsigned();
            $table->string('observaciones')->nullable();

            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('metodoPago_id')->references('id')->on('metodoPagos');
            $table->foreign('comprobante_id')->references('id')->on('comprobantes');


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
        Schema::drop('compras');
    }
}