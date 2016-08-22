<?php

namespace Salesfly\Salesfly\Managers;
class DocenteManager extends BaseManager {
    public function getRules()
    {
        $rules = [  
                    'nombres'=>'required',
                    'apellidos'=>'required',
                    'dni' => 'required',
                    'fechaNac'=> '',
                    'fechaRegistro'=> '',
                    'sexo' => '',
                    'curriculo' => '',
                    'gradoAcademico' => '',
                    'email'=> '',
                    'telefono'=> '',
                    'nacionalidad'=> '',
                    'pais'=> '',
                    'estado'=> '',
                    'ubigeo_id'=> '',
                    'profesion_id'=> ''
                  ];
        return $rules;
    }
} 
