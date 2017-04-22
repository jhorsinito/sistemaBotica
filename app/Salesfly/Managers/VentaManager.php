<?php

namespace Salesfly\Salesfly\Managers;

class VentaManager extends BaseManager{

    public function getRules(){
        $rules = [
            'nombre' => '',
            'codigo' => '',
            'descripcion' => '',
            'numero' => '',
            'igv' => '',
            'monto' => '',
            'precioventa' => '',
            'comprobante_id' => 'integer',
            'tienda_id' => 'integer',
            'user_id' => 'required|integer',
            'cliente_id' => 'integer',
            'product_id' => 'integer',
            'estado' => 'required|boolean',
            'estado2' => ''];

        
        return $rules;
    }
}