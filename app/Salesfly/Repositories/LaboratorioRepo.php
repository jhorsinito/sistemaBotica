<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Laboratorio;

class LaboratorioRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Laboratorio;
    }

    public function search($q)
    {
        $laboratorios =Laboratorio::where('nombre','like', $q.'%')
                    ->paginate(15);
        return $laboratorios;
    }
    public function traerLaboratorios()
    {
        $laboratorios =Laboratorio::get();
        return $laboratorios;
    }
} 