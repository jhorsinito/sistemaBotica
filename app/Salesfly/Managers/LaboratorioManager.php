<?php

namespace Salesfly\Salesfly\Managers;
class LaboratorioManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                     'nombre'=> 'required',
            		'shortName'=>'',
            		'descripcion'=>''
                  ];
        return $rules;
    }
} 
