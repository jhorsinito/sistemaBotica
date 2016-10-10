<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetPresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detPres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variante_id')->unsigned();
            $table->integer('presentacion_id')->unsigned();
            $table->decimal('suppPri',10,2)->default(0);
            $table->decimal('markup',10,2)->default(0);
            $table->decimal('price',10,2)->default(0);
            $table->foreign('variante_id')->references('id')->on('variantes');
            $table->foreign('presentacion_id')->references('id')->on('presentaciones');
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
