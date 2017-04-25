<?php

namespace Salesfly\Salesfly\Managers;
class DetGrupoFarmaceuticoVarianteManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                     'grupoFarmacologico_id'=> '',
            		'variant_id'=>''
                  ];
        return $rules;
    }

} 
} 

