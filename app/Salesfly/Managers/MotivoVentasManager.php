<?php
namespace Salesfly\Salesfly\Managers;
class MotivoVentasManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'descripcion'=> 'required'
                  ];
        return $rules;
    }}