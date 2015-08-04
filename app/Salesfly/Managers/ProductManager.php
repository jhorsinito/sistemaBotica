<?php

namespace Salesfly\Salesfly\Managers;

class ProductManager extends BaseManager{

    public function getRules(){
        $rules = [
            'nombre' => 'required',
            'codigo' => 'required',
            'suppCode' => 'required',
            'hasVariants' => 'required',
            'descripcion' => '',
            'type_id' => '',
            'brand_id' => '',
            'material_id' => '',
            'station_id' => '',
            'estado' => 'required',
            'image' => ''

        ];
        return $rules;
    }
}