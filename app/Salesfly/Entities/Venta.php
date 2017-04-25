<?php
namespace Salesfly\Salesfly\Entities;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $table = 'ventas';

    protected $fillable = ['nombre',
                            'codigo',
                            'descripcion',
                            'numero',
                            'igv',
                            'monto',
                            'precioventa',
                            'comprobante_id',
                            'tienda_id',
                            'cliente_id',
                            'product_id',
                            'estado',
                            'estado2',
                            'user_id'
                            ];


    public function tienda(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\Tienda');
    }
    public function comprobante(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\Comprobante');
    }
  
    public function cliente(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\Cliente');
    }
    public function product(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\Product');
    }


   
}
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
