<?php
namespace Salesfly\Salesfly\Managers;
class BrandManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'nombre'=> 'required',
            'shortname'=> '',
            'descripcion'=> ''
                  ];
        return $rules;
    }}