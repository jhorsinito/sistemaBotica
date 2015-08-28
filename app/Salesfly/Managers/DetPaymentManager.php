<?php
namespace Salesfly\Salesfly\Managers;
class DetPaymentManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'fecha'=>'',
            'payment_id'=>'',
            'tipoPago'=>'',
            'methodPayment_id'=>'',
            'montoPagado'=>''
                  ];
        return $rules;
    }}