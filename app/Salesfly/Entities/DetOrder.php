<?php
namespace Salesfly\Salesfly\Entities;

class DetOrder extends \Eloquent {

	protected $table = 'detOrders';
    
    protected $fillable = ['precioProducto',
    						'precioVenta',
    						'cantidad',
    						'descuento',
    						'subTotal',
    						'order_id',
    						'detPre_id'];
}