<?php
namespace Salesfly\Salesfly\Managers;
class DetailOrderPurchaseManager extends BaseManager {

    public function getRules()
    {
        $rules = ['producto'=>'',
                   'descuento'=> '',
        			'montoBruto'=>'',
        			'montoTotal'=>'',
        			'detPres_id'=>'',
        			'orderPurchases_id'=>'',
                    'preProducto'=>'',
                    'preCompra'=>'',
                    'cantidad'=>'',
                    'Cantidad_Ll'=>''
       				 ];
        return $rules;
    }
}