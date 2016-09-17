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
          $table->string('tipo')->nullable();
          $table->string('nombreMarca')->nullable();
          $table->string('nombreGenerico')->nullable();
          $table->string('formaFarmaceutica')->nullable();
          $table->string('viaAdministracion')->nullable();
          $table->string('fechaVencimiento')->nullable();
          $table->string('lote')->nullable();
          $table->string('laboratorio')->nullable();
          $table->string('grupoFarmacologico')->nullable();
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
