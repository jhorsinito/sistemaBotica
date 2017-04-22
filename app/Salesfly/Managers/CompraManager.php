<?php
namespace Salesfly\Salesfly\Managers;
class CompraManager extends BaseManager {

    public function getRules()
    {
        $rules = [ 'proveedor_id'=> 'required|integer',
            	   'user_id'=> 'required|integer',
            	   'metodoPago_id'=> 'required|integer',
            	   'comprobante_id'=> 'required|integer',
            	   'observaciones'=> ''
                  ];
        return $rules;
    }}