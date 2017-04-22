<?php
namespace Salesfly\Salesfly\Managers;
class MetodoPagoManager extends BaseManager {
    public function getRules()
    {
        $rules = [  		'nombre'=>'required',
    						'descripcion'=>'' ];
        return $rules;
    }}