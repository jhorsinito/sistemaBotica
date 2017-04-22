<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\MetodoPago;
class MetodoPagoRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new MetodoPago;
    }
    public function search($q)
    {
        $MetodoPago =MetodoPago::where('nombre','like', $q.'%')
                    ->orwhere('descripcion','like', $q.'%')
                    ->paginate(15);
        return $MetodoPago;
    }
    public function allMetodoPagos()
    {
        $MetodoPago =MetodoPago::orderBy('nombre', 'asc')
                        ->get();
        return $MetodoPago;
    }
     
} 