<?php
namespace Salesfly\Salesfly\Managers;
class PaymentManager extends BaseManager {

    public function getRules()
    {
        $rules = [   
            'NumFactura'=>'',           
            'montoTotal'=>'',
            'Acuenta'=>'',
            'Saldo'=>'',
            //'estado'=>'',
            'orderPurchase_id'=>'',
            'purchase_id'=>'',
            'supplier_id'=>''
                  ];
        return $rules;
    }}