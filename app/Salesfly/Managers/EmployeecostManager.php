<?php

namespace Salesfly\Salesfly\Managers;
class EmployeecostManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                    'SueldoFijo'=>'',
                    'comisiones'=>'',
                    'seguro'=>'',
                    'menu'=>'',
                    'pasajes'=>'',
                    'total'=>'',
                    'employee_id'=>''
                  ];
        return $rules;
    }
} 
