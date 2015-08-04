<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('codigo');
            $table->date('fechanac');
            $table->string('fijo');
            $table->string('movil');
            $table->string('email');
            $table->text('imagen');
            $table->char('genero',1);
            $table->string('direccioncontacto');
            $table->string('twitter');
            $table->string('distrito');
            $table->string('provincia');
            $table->string('departamento');
            $table->string('pais');
            $table->text('notas');
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
       Schema::drop('employees');
    }
}
