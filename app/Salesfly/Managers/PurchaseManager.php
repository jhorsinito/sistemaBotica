<?php
namespace Salesfly\Salesfly\Managers;
class PurchaseManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'fechaEntrega'=>'',
             'descuento'=>'between:0,9999999999.00',
             'montoBruto'=>'between:0,9999999999.00',
             'montoTotal'=>'between:0,9999999999.00',
             'orderPurchase_id'=>'',
             'warehouses_id'=>'required',
                    'supplier_id'=>'required',
                    'observacion'=>'',
                    'tCambio'=>'',
                    'tasaDolar'=>'between:0,9999999999.00',
                    'montoBrutoDolar'=>'between:0,9999999999.00',
                    'montoTotalDolar'=>'between:0,9999999999.00'];
        return $rules;
    }}