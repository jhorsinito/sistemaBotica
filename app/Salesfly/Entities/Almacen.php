<?php
namespace Salesfly\Salesfly\Entities;

class Almacen extends \Eloquent {
	
	protected $table = 'almacenes';
    
    protected $fillable = ['nombreAlmacen',
    						'descripcion',
    						'tienda_id'];

   	public function tienda()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Tienda');
    }

    public function caja()
    {
        return $this-> hasmany(Caja::class);
    }


}