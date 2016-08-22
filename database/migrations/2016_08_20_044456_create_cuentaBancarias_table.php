<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaBancariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentaBancarias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numeroCuenta')->nullable();
            $table->integer('banco_id')->unsigned();
            
            $table->foreign('banco_id')->references('id')->on('bancos');
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
        Schema::drop('cuentaBancarias');
    }
}
