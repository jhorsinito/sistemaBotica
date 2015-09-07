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
                    'supplier_id'=>'',
                    'observacion'=>''];
        return $rules;
    }}