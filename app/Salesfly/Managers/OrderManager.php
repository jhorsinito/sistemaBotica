<?php
namespace Salesfly\Salesfly\Managers;
class OrderManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'fechaPedido'=> 'required',
            'montoTotal'=> '',
            'montoBruto'=> '',
            'descuento'=> '',
            'fechaAnulado'=> '',
            'estado'=>'',
            'employee_id'=> 'required',
            'customer_id'=> 'required',
            'igv'=> '',
            'notas'=> ''
                  ];
        return $rules;
    }}
 