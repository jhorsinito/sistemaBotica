<?php

namespace Salesfly\Salesfly\Managers;
class DetComercialGenericoManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                     'productoComercial_id'=> '',
            		'productoGenerico_id'=>''
                  ];
        return $rules;
    }
} 

} 