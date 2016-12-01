<?php
namespace Salesfly\Salesfly\Entities;

class Venta extends \Eloquent {
	
	protected $table = 'ventas';
    
    protected $fillable = ['nombreVenta'];

   	public function producto()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Producto');
    }
}