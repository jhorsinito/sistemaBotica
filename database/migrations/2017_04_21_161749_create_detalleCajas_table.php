<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleCajas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fechaInicio')->nullable();
            $table->string('fechaFin')->nullable();
            $table->decimal('montoInicial', 10, 2);
            $table->decimal('Ingresos', 10, 2);
            $table->decimal('gastos', 10, 2);
            $table->decimal('montoBruto', 10, 2);
            $table->decimal('montoReal', 10, 2);
            $table->decimal('descuadre', 10, 2);
            $table->string('notas')->nullable();
            $table->integer('caja_id')->unsigned();
            $table->foreign('caja_id')->references('id')->on('cajas');
            
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
        Schema::drop('detalleCajas');
    }
}