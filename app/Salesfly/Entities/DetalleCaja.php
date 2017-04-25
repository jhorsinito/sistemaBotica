<?php
namespace Salesfly\Salesfly\Entities;

class DetalleCaja extends \Eloquent {
	
	protected $table = 'detalleCajas';
    
    protected $fillable = [ 'fechaInicio', 
    						'fechaFin', 
    						'montoInicial', 
    						'Ingresos', 
    						'gastos',
    						'montoBruto',
    						'montoReal',
    						'descuadre', 
    						'notas',
    						'caja_id',
    						'user_id'];
   public function caja()
    {  
        return $this-> hasmany(Caja::class);
    }
}