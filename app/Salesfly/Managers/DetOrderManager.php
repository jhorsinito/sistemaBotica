<?php
namespace Salesfly\Salesfly\Managers;
class DetOrderManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'precioProducto'=> '',
            'precioVenta'=> '',
            'cantidad'=> '',
            'descuento'=> '',
            'subTotal'=> '',
            'order_id'=> '',
            'detPre_id'=> ''];
        return $rules;
    }}