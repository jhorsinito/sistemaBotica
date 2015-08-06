<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailPurchases', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('descuento',10,2);
            $table->decimal('montoBruto',10,2);
            $table->decimal('montoTotal',10,2);
            $table->integer('variants_id')->unsigned();
            $table->foreign('variants_id')->references('id')->on('variants');
            $table->integer('purchases_id')->unsigned();
            $table->foreign('purchases_id')->references('id')->on('purchases');
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
        Schema::drop('detailPurchases');
    }
}
