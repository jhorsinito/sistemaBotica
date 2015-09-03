<?php

namespace Salesfly\Salesfly\Managers;
class SaleDetPaymentManager extends BaseManager {

    public function getRules()
    {
        $rules = [ 
                    'fecha'=>'',
                    'monto'=>'',
                    'numCaja'=>'',
            'salePayment_id' => '',
            'saleMethodPayment_id' => ''
                  ];
        return $rules;
    }
} 