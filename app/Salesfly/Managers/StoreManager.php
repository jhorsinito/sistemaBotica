<?php

namespace Salesfly\Salesfly\Managers;
class StoreManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                    'nombreTienda'=>'',
                    'razonSocial'=>'',
                    'ruc'=>'',
                    'direccion'=>'',
                    'distrito'=>'',
                    'provincia'=>'',
                    'departamento'=>'',
                    'email'=>'',
                    'website'=>''
                  ];
        return $rules;
    }
} 

