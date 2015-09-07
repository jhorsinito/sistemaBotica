<?php

namespace Salesfly\Salesfly\Managers;

class ProductManager extends BaseManager{

    public function getRules(){
        $rules = [
            'nombre' => 'required',
            'codigo' => 'required',
            'suppCode' => 'required',
            'hasVariants' => 'required|boolean',
            'descripcion' => '',
            'type_id' => 'integer',
            'brand_id' => 'integer',
            'material_id' => 'integer',
            'station_id' => 'integer',
            'estado' => 'required|boolean',
            'image' => '',
            'modelo' => '',
            'presentation_base' => 'integer',
            'user_id' => 'required|integer'

        ];
        return $rules;
    }
}