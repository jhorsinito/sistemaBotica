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
            $table->string('empresa')->nullable();
            $table->string('codigo')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ruc')->nullable();
            $table->integer('dni')->nullable();
            $table->integer('numCuenta')->nullable();
            $table->string('fechaNac')->nullable();
            $table->string('genero')->nullable();
            $table->string('tel_fijo')->nullable();
            $table->string('tel_movil')->nullable();
            $table->string('email')->unique();
            $table->string('webSite')->nullable();
            $table->string('notas')->nullable();
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
