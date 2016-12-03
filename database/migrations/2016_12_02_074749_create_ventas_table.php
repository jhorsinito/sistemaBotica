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
            $table->string('serie')->unique();
            $table->string('numero')->nullable();
            $table->decimal('montoTotal', 10, 2);
            $table->decimal('montoBruto', 10, 2);
            $table->decimal('descuento', 10, 2);
            $table->string('fechaAnulado')->nullable();
            $table->decimal('igv', 10, 2);
            $table->string('notas')->nullable();
            $table->integer('tipoDocumento_id')->unsigned();
            $table->integer('detalleCaja_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('tipoDocumento_id')->references('id')->on('tipoDocumentos');
            $table->foreign('detalleCaja_id')->references('id')->on('detalleCajas');
            $table->foreign('cliente_id')->references('id')->on('clientes');
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
