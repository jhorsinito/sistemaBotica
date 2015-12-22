<?php
namespace Salesfly\Salesfly\Managers;
class PromocionManager extends BaseManager {

    public function getRules()
    {
        $rules = ['descripcion'=> '',
                    'cantidad'=>'required',
    				'productBase_id'=>'required',
    				'product_id'=> 'required',
    				'fecha_inicio'=>'required',
    				'fecha_fin'=>'required',
    				'descuento'=> 'required',
    				'estado'=>''];
        return $rules;
    }
}