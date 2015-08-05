<?php

namespace Salesfly\Salesfly\Managers;

class VariantManager extends BaseManager{

    public function getRules(){
        $rules = [
            'sku' => 'required',
            'suppPri' => 'required|between:0,99999.99',
            'markup' => 'required|between:0,99999.99',
            'price' => 'required|between:0,99999.99',
            'track' => 'required|boolean',
            'product_id' => 'required|integer'

        ];
        return $rules;
    }
}