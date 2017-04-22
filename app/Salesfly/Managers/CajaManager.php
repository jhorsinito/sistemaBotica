<?php
namespace Salesfly\Salesfly\Managers;
class CajaManager extends BaseManager {

    public function getRules()
    {
        $rules = [ 'nombreCaja'=> 'required',
                    'descripcion'=> '',
                    'turno'=> '',
                    'fecha'=> '',
                    'tienda_id' => '',
                    'almacen_id' => '',
                    'user_id' => '',
                    'estado2' => ''];
                    
        return $rules;
    }}