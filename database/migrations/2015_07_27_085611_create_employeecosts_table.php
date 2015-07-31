<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeecostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeecosts', function (Blueprint $table) {
            $table->increments('id');
            $table->double('SueldoFijo');
            $table->double('comisiones');
            $table->double('seguro');
            $table->double('menu');
            $table->double('pasajes');
            $table->double('total');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::drop('employeecosts');
    }
}
