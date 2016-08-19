<?php
namespace Salesfly\Salesfly\Managers;
class MedioPublicitarioManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'descripcion'=> 'required'
                  ];
        return $rules;
    }}