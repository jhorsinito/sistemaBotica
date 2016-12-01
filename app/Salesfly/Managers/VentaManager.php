<?php
namespace Salesfly\Salesfly\Managers;
class VentaManager extends BaseManager {
    public function getRules()
    {
        $rules = [  		'nombreVenta'=>'required',
    						'descripcion'=>'',
    						'tienda_id'=>''
    						];
        return $rules;
    }}