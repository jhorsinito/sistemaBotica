<?php
namespace Salesfly\Salesfly\Entities;

class Cliente extends \Eloquent {
	
	protected $table = 'clientes';
    
    protected $fillable = [ 'nombreCliente', 
    						'empresa', 
    						'direccion', 
    						'ruc', 
    						'dni',
    						'codigo',
    						'fechaNac',
    						'genero', 
    						'tel_fijo',
    						'tel_movil',
    						'email', 
    						'webSite', 
    						'pais', 
    						'departamento', 
    						'provincia', 
    						'distrito', 
    						'notas'];

   	public function venta()
    {
        //return $this->belongsTo('\Salesfly\Salesfly\Entities\Tienda');
    }
}