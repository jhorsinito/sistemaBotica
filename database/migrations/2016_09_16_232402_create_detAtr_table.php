<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetAtrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detAtr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variante_id')->unsigned();
            $table->integer('atribute_id')->unsigned();
            $table->string('descripcion');
            $table->foreign('variante_id')->references('id')->on('variantes');
            $table->foreign('atribute_id')->references('id')->on('atributes');
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
