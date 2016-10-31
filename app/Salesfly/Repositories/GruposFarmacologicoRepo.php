<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\GruposFarmacologico;

class GruposFarmacologicoRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new GruposFarmacologico;
    }
    public function buscarGrupoFarmaceutico($dato)
    {
        $laboratorios =GruposFarmacologico::where('nombre','like', $dato.'%')
                    ->get();
        return $laboratorios;
    }
} 