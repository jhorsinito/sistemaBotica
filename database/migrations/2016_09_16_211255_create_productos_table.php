<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('productos', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombreProducto')->nullable();
          $table->string('tipo_medicamento')->nullable();
          $table->string('tipo')->nullable();
          $table->string('codigo')->nullable();
          $table->string('descripcion')->nullable();
          $table->string('imagen')->nullable();
          $table->integer('hasvariants')->nullable();
          $table->integer('estado')->nullable();
          $table->integer('quantVar')->nullable();
          $table->string('presentacionBase')->nullable();
          

          $table->integer('marca_id')->unsigned()->nullable();
          //$table->integer('producto_id')->unsigned()->nullable();
         
          $table->integer('user_id')->unsigned()->nullable();

          $table->foreign('marca_id')->references('id')->on('marcas');
          //$table->foreign('producto_id')->references('id')->on('productos');
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
        //
    }
}
