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
             'warehouses_id'=>'required',
             'suppliers_id'=>'required'];
        return $rules;
    }}