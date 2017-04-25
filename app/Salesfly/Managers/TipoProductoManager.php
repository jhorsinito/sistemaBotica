<?php

namespace Salesfly\Salesfly\Managers;
class TipoProductoManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                     'nombre'=> '',
            		'descripcion'=>''
                  ];
        return $rules;
    }

} 

} 

