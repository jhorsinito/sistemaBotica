<?php

namespace Salesfly\Salesfly\Managers;

class VariantManager extends BaseManager{

    public function getRules(){
        $rules = [
            'sku' => 'required',
            'suppPri' => 'between:0,99999.99',
            'markup' => 'between:0,99999.99',
            'price' => 'between:0,99999.99',
            'track' => 'required|boolean',
            'product_id' => 'required|integer'

        ];
        return $rules;
    }
}