<?php
namespace Salesfly\Salesfly\Managers;
class PurchaseManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'fechaEntrega'=>'',
             'descuento'=>'',
             'montoBruto'=>'',
             'montoTotal'=>'',
             'orderPurchase_id'=>'',
             'warehouses_id'=>'',
                    'suppliers_id'=>''];
        return $rules;
    }}