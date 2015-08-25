<?php
namespace Salesfly\Salesfly\Entities;

class DetCash extends \Eloquent {

	protected $table = 'detCash';
    
    protected $fillable = ['fecha',
    						'hora',
    						'montoCaja',
    						'montoMovimiento',
    						'montoFinal',
    						'estado',
    						'observacion',
    						'cashMotive_id',
    						'cash_id'];
}