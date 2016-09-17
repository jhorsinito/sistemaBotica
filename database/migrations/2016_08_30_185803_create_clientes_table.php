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
            $table->string('apellido')->nullable();
            $table->string('empresa')->nullable();
            $table->string('direcFiscal')->nullable();
            $table->string('ruc')->nullable();
            $table->string('dni')->nullable();
            $table->string('codigo')->nullable();
            $table->string('fechaNac')->nullable();
            $table->string('genero')->nullable();
            $table->string('tel_fijo')->nullable();
            $table->string('tel_movil')->nullable();
            $table->string('email')->nullable();
            $table->string('webSite')->nullable();
            $table->string('direcCon')->nullable();
            $table->string('distrito')->nullable();
            $table->string('provincia')->nullable();
            $table->string('dpto')->nullable();
            $table->string('pais')->nullable();
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
        //
    }
}
