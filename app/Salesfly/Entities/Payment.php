<?php
namespace Salesfly\Salesfly\Entities;

class Payment extends \Eloquent {

	protected $table = 'payments';
    
    protected $fillable = ['NumFactura','montoTotal','Acuenta','Saldo','estado','orderPurchase_id','purchase_id','supplier_id'];

}