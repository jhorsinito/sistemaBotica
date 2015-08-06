<?php
namespace Salesfly\Salesfly\Entities;

class Purchase extends \Eloquent {

    protected $table = 'purchases';
    
    protected $fillable = [ 
                    'fechaPedido',
                    'fechaPrevista',
                    'fechaEntrega',
                    'descuento',
                    'montoBruto',
                    'montoTotal',
                    'Estado',
                    'warehouses_id',
                    'suppliers_id'];
     public function warehouse()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Warehouse');
    }
     public function supplier()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Supplier');
    }

}