<?php
namespace Salesfly\Salesfly\Entities;

class Venta extends \Eloquent {
	
	protected $table = 'ventas';
    
  protected $fillable = ['serie',
    					 'numero',
    					 'montoTotal',
    					 'montoBruto',
    					 'descuento',
    					 'fechaAnulado',
    					 'igv',
    					 'notas',
    					 'tipoDocumento_id',
    					 'detalleCaja_id',
    					 'cliente_id',
    					 'user_id'];


   	public function tipoDocumento()
    {  
        return $this-> hasmany(TipoDocumento::class);
    }


    public function detalleCaja()
    {  
        return $this-> hasmany(DetalleCaja::class);
    }


     public function cliente()
    {  
        return $this-> hasmany(Cliente::class);
    }
}
