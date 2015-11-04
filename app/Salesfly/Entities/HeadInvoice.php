<?php
namespace Salesfly\Salesfly\Entities;

class HeadInvoice extends \Eloquent {

	protected $table = 'headInvoices';
    
    protected $fillable = ['numero',
    						'cliente',
    						'direccion',
    						'ruc',
                            'GRemicion',
    						'subTotal',
    						'igv',
    						'Total',
    						'venta_id',
    						'cliente_id',
                            'tipoDoc'];
    
}