<?php
namespace Salesfly\Salesfly\Managers;
class CuentaBancariaManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'numeroCuenta'=> 'required',
            'banco_id'=> 'required'
                  ];
        return $rules;
    }}