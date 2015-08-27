<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('detOrders', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('precioProducto',10,2);
            $table->decimal('precioVenta',10,2);
            $table->decimal('cantidad',10,2);
            $table->decimal('descuento',10,2);
            $table->decimal('subTotal',10,2);

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->integer('detPre_id')->unsigned();
            $table->foreign('detPre_id')->references('id')->on('detPres');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('detOrders');
    }
}
