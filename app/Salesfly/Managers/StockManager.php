<?php

namespace Salesfly\Salesfly\Managers;
class StockManager extends BaseManager {

    public function getRules()
    {
        $rules = ['stockActual'=>'',
                            'stockMin'=>'',
                            'stockMinSoles'=>'',
                            'warehouse_id'=>'',
                            'variant_id'=>''];
        return $rules;
    }
} 
