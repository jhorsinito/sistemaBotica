<?php
namespace Salesfly\Salesfly\Managers;
class ProfesionManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'nombre'=> 'required',
            'descripcion'=> ''
                  ];
        return $rules;
    }}