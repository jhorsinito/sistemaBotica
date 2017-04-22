<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombreCliente')->nullable();
            $table->string('empresa');
            $table->string('direccion');
            $table->integer('ruc');
            $table->integer('dni');
            $table->string('codigo');
            $table->string('fechaNac');
            $table->string('genero');
            $table->integer('tel_fijo');
            $table->integer('tel_movil');
            $table->string('email');
            $table->string('webSite');
            $table->string('notas');
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
        Schema::drop('clientes');
    }
}