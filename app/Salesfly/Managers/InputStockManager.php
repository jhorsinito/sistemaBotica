<?php
namespace Salesfly\Salesfly\Managers;
class InputStockManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'cantidad_llegado'=>'','descripcion'=>'','variant_id'=>''
                  ];
        return $rules;
    }}