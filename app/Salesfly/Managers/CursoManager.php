<?php
namespace Salesfly\Salesfly\Managers;
class CursoManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'fechaRegistro'=> 'required',
            'descripcion'=> 'required'
                  ];
        return $rules;
    }}