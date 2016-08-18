<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\MotivoVentas;

class MotivoVentasRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new MotivoVentas;
    }

    public function search($q)
    {
        $motivoVentas =MotivoVentas::where('descripcion','like', $q.'%')
                    ->paginate(15);
        return $motivoVentas;
    }
} 