<?php

namespace Salesfly\Salesfly\Managers;
class GruposFarmacologicoManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                     'nombre'=> '',
            		'descripcion'=>''
                  ];
        return $rules;
    }
} 