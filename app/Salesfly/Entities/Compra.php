<?php
namespace Salesfly\Salesfly\Entities;

class Compra extends \Eloquent {
	
	protected $table = 'compras';
    
    protected $fillable = [ 'proveedor_id', 
    						'user_id',
                            'metodoPago_id',
                            'comprobante_id'
    						];

    public function proveedor()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Proveedor');
    }
    /*public function user()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Users');
    }*/

    public function metodoPago()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\MetodoPago');
    }

    public function comprobante()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Comprobante');
    }
}