<?php
namespace Salesfly\Salesfly\Entities;

class MetodoPago extends \Eloquent {

	protected $table = 'metodoPagos';
    
    protected $fillable = [ 'nombre',
    						'descripcion'];


   
    public function compra()
    {
    	return $this-> hasmany(Compra::class);
    }

}