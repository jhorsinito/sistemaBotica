<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombreProveedor')->nullable();
            $table->integer('tipoDocumento_id')->unsigned();
            $table->integer('numDocumento')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('numCuenta')->nullable();
            $table->string('telefonos')->nullable();
            $table->string('email')->unique();
            $table->string('webSite')->nullable();
            $table->foreign('tipoDocumento_id')->references('id')->on('tipoDocumentos');
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
        Schema::drop('proveedores');
    }
}