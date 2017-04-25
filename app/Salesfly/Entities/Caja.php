<?php
namespace Salesfly\Salesfly\Entities;

class Caja extends \Eloquent {

    protected $table = 'cajas';
    
    protected $fillable = ['nombreCaja',
    					   'descripcion',
    					   'turno',
    					   'fecha',
    					   'tienda_id',
    					   'almacen_id',
    					   'user_id',
    					   'estado2'];


     public function tienda(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\Tienda');
    }
    public function almacen(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\Almacen');
    }


	
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