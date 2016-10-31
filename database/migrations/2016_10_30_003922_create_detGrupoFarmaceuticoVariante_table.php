<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetGrupoFarmaceuticoVarianteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detGrupoFarmaceuticoVariante', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grupoFarmacologico_id')->unsigned();
            $table->integer('variant_id')->unsigned();
            $table->foreign('grupoFarmacologico_id')->references('id')->on('gruposFarmacologicos');
            $table->foreign('variant_id')->references('id')->on('variants');
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
        Schema::drop('detGrupoFarmaceuticoVariante');
    }
}
