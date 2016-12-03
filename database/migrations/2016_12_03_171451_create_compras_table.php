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
            $table->integer('numero')->nullable();
            $table->integer('descuento')->nullable();
            $table->decimal('montoBruto', 10, 2);
            $table->decimal('montoTotal', 10, 2);
            $table->string('observaciones')->nullable();
            $table->decimal('igv', 10, 2);
            $table->integer('tipoDocumento_id')->unsigned();
            $table->integer('almacen_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('tipoDocumento_id')->references('id')->on('tipoDocumentos');
            $table->foreign('almacen_id')->references('id')->on('almacenes');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('user_id')->references('id')->on('users');
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
