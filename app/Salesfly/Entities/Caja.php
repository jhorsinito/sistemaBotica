<?php
namespace Salesfly\Salesfly\Entities;

class Caja extends \Eloquent {
	
	protected $table = 'cajas';
    
    protected $fillable = [ 'nombreCaja', 
    						'ambiente', 
    						'descripcion', 
    						'tienda_id'
                            ];
   	public function tienda()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Tienda');
    }
}