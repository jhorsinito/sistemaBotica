<?php
namespace Salesfly\Salesfly\Managers;
class SaleManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'fechaPedido'=> 'required',
            'fechaEntrega'=>'',
            'montoTotal'=> '',
            'montoBruto'=> '',
            'descuento'=> '',
            'fechaAnulado'=> '',
            'estado'=>'',
            'employee_id'=> '',
            'customer_id'=> '',
            'igv'=> '',
            'notas'=> '',
            'cash_id'=>'required',
            'orderSale_id'=> '',
            'separateSale_id'=> ''
                  ];
        return $rules;
    }} 
 