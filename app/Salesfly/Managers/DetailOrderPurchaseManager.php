<?php
namespace Salesfly\Salesfly\Managers;
class DetailOrderPurchaseManager extends BaseManager {

    public function getRules()
    {
        $rules = ['descuento'=> '',
        			'montoBruto'=>'',
        			'montoTotal'=>'',
        			'detPres_id'=>'',
        			'orderPurchases_id'=>'',
                    'preProducto'=>'',
                    'preCompra'=>'',
                    'cantidad'=>''
       				 ];
        return $rules;
    }
}