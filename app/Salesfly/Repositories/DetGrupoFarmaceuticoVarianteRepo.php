<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetGrupoFarmaceuticoVariante;

class DetGrupoFarmaceuticoVarianteRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new DetGrupoFarmaceuticoVariante;
    }
    public function cargarDetGrupoFarmaceuticoVariantes($dato)
    {
        $detComercialGenerico =DetGrupoFarmaceuticoVariante::leftjoin('gruposFarmacologicos','gruposFarmacologicos.id','=','detGrupoFarmaceuticoVariante.grupoFarmacologico_id')
        						->where('variant_id','=',$dato)
        						->select('detGrupoFarmaceuticoVariante.*','gruposFarmacologicos.nombre as nombre')
        						->get();
        return $detComercialGenerico;
    }

} 