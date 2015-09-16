<?php
namespace Salesfly\Salesfly\Managers;
class InputStockManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'cantidad_llegado'=>'required','descripcion'=>'','variant_id'=>'required','headInputStock_id'=>'required'
                  ];
        return $rules;
    }}