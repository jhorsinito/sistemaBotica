<?php
namespace Salesfly\Salesfly\Managers;
class AcreditadoraManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'nombre'=> 'required',
            'ubigeo_id'=> 'required'
                  ];
        return $rules;
    }}