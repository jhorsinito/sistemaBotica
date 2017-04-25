<?php


namespace Salesfly\Salesfly\Managers;


class DetAtrManager extends BaseManager{

    public function getRules(){
        return ['variant_id' => 'required|integer',
            'atribute_id' => 'required|integer',
            'descripcion' => 'required'
        ];
    }

} 