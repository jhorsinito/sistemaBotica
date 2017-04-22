<?php
namespace Salesfly\Salesfly\Entities;

class DetalleCompra extends \Eloquent {
	
	protected $table = 'detallecompras';
    
    protected $fillable = [ 'variant_id', 
    						'compra_id', 
    						'numero', 
    						'descuento', 
    						'montoBrutoSoles',
    						'igvSoles',
    						'montoTotalSoles',
    						'tipoCambio', 
    						'montoBrutoDolares',
    						'igvDolares',
    						'montoTotalDolares',
                            'observaciones'];


    public function variant()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Variant');
    }

    public function compra()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Compra');
    }
}