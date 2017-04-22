<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleCompras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variant_id')->unsigned();
            $table->integer('compra_id')->unsigned();
            $table->integer('numero')->nullable();
            $table->decimal('descuento', 10, 2);
            $table->decimal('montoBrutoSoles', 10, 2);
            $table->decimal('igvSoles', 10, 2);
            $table->decimal('montoTotalSoles', 10, 2);
            $table->decimal('tipoCambio', 10, 2);
            $table->decimal('montoBrutoDolares', 10, 2);
            $table->decimal('igvDolares', 10, 2);
            $table->decimal('montoTotalDolares', 10, 2);  
            $table->string('observaciones')->nullable();

            $table->foreign('variant_id')->references('id')->on('variants');
            $table->foreign('compra_id')->references('id')->on('compras');

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
        Schema::drop('detalleCompras');
    }
}