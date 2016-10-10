<?php
namespace Salesfly\Salesfly\Managers;
class MarcaManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'nombre'=> 'required',
            'descripcion'=> ''
                  ];
        return $rules;
    }}