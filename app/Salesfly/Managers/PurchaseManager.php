<?php
namespace Salesfly\Salesfly\Managers;
class PurchaseManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'fechaPedido'=>'',
            'fechaPrevista'=>'',
            'fechaEntrega'=>'',
             'descuento'=>'',
             'montoBruto'=>'',
             'montoTotal'=>'',
             'Estado'=>'',
             'warehouses_id'=>'',
                    'suppliers_id'=>''];
        return $rules;
    }}