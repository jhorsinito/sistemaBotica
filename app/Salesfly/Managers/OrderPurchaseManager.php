<?php
namespace Salesfly\Salesfly\Managers;
class OrderPurchaseManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'fechaPedido'=>'',
            'fechaPrevista'=>'',
             'descuento'=>'',
             'montoBruto'=>'',
             'montoTotal'=>'',
             'Estado'=>'',
             'warehouses_id'=>'',
             'suppliers_id'=>''];
        return $rules;
    }}