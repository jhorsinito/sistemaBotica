<?php

namespace Salesfly\Salesfly\Managers;
class SalePaymentManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                    'MontoTotal'=>'',
                    'Acuenta'=>'',
            'Saldo' => '',
            'estado' => '',
            'order_id'=> '',
            'customer_id' => ''];
        return $rules;
    }
} 