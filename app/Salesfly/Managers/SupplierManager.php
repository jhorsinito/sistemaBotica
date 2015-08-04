<?php

namespace Salesfly\Salesfly\Managers;
class SupplierManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                    'nombres'=>'required',
                            'apellidos'=>'required',
                            'empresa'=>'required',
                            'codigo'=>'required',
                            'direccionfiscal'=>'',
                            'ruc'=>'',
                            'numcuenta'=>'',
                            'fechanac'=>'',
                            'fijo'=>'',
                            'movl'=>'',
                            'email'=>'',
                            'website'=>'',
                            'genero'=>'',
                            'direccontacto'=>'',
                            'distrito'=>'',
                            'twitter'=>'',
                            'provincia'=>'',
                            'departamento'=>'',
                            'pais'=>'',
                            'notas'=>''
                  ];
        return $rules;
    }
} 
