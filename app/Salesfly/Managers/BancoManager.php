<?php
namespace Salesfly\Salesfly\Managers;
class BancoManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'nombre'=> 'required'
                  ];
        return $rules;
    }}