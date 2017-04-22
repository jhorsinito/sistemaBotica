<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Caja;

class CajaRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Caja;
    }

    public function search($q)
    {
        $cajas =Caja::where('nombreCaja','like', $q.'%')
                    ->paginate(15);
        return $cajas;
    }
    public function allCajas()
    {
        $cajas =Caja::get();
        return $cajas;
    }
}