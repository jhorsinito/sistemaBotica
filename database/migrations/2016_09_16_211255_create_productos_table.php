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
          $table->string('inagen')->nullable();
          $table->int('hasvariants')->nullable();
          $table->int('estado')->nullable();
          $table->string('presentacionBase')->nullable();

          $table->int('marca_id')->nullable();
          $table->int('producto_id')->nullable();
         
          $table->int('user_id')->nullable();

          $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('producto_id')->references('id')->on('productos');
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
