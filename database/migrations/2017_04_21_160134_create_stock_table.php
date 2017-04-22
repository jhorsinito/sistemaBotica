<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->increments('id');    
            $table->decimal('stockActual',10,2)->default(0);
            $table->decimal('stockMin',10,2)->default(0);
            $table->decimal('stockMinSoles',10,2)->nullable()->default(0);
            $table->decimal('stockPedidos',10,2)->default(0);
            $table->decimal('stockSeparados',10,2)->default(0);
            $table->decimal('porLlegar',10,2)->default(0);
            $table->integer('variant_id')->unsigned();
            $table->integer('almacen_id')->unsigned();
            $table->foreign('variant_id')->references('id')->on('variants');
            $table->foreign('almacen_id')->references('id')->on('almacenes');
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
        Schema::drop('stock');
    }
}