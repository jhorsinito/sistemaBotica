<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->string('codigo')->unique();
            $table->string('numero')->unique(); 
   
            $table->string('descripcion')->nullable();
          
           
            $table->integer('tienda_id')->unsigned()->nullable(); //si deseo agrego tipo
            $table->integer('comprobante_id')->unsigned()->nullable(); // si.
            $table->integer('cliente_id')->unsigned()->nullable(); //si..
            $table->integer('product_id')->unsigned()->nullable(); //si..
           
          
            $table->foreign('tienda_id')->references('id')->on('tiendas');
            $table->foreign('comprobante_id')->references('id')->on('comprobantes');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('product_id')->references('id')->on('products');
           
            $table->boolean('estado'); 
            $table->integer('user_id')->unsigned();
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
        Schema::drop('ventas');
    }
}