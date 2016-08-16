<?php
namespace Salesfly\Salesfly\Managers;
class UbigeoManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'codigo'=> 'required',
            'distrito'=> 'required',
            'provincia'=> 'required',
            'departamento'=> 'required'
                  ];
        return $rules;
    }}