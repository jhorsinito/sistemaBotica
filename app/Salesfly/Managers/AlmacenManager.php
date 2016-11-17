<?php
namespace Salesfly\Salesfly\Managers;
class AlmacenManager extends BaseManager {
    public function getRules()
    {
        $rules = [  		'nombreAlmacen'=>'required',
    						'descripcion'=>'',
    						'tienda_id'=>''
    						];
        return $rules;
    }}