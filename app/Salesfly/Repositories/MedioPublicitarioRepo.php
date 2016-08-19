<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\MedioPublicitario;

class MedioPublicitarioRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new MedioPublicitario;
    }

    public function search($q)
    {
        $motivoVentas =MedioPublicitario::where('descripcion','like', $q.'%')
                    ->paginate(15);
        return $motivoVentas;
    }
} 