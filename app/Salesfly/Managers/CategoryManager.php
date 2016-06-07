<?php
namespace Salesfly\Salesfly\Managers;
class CategoryManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'nombre'=> 'required',
            'shortname'=> 'required',
            'descripcion'=> ''
                  ];
        return $rules;
    }}