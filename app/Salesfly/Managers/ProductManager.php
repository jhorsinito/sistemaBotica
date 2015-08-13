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
            'presentation_base' => 'integer'

        ];
        return $rules;
    }
}