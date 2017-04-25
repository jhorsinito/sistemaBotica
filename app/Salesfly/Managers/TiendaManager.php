<?php
namespace Salesfly\Salesfly\Managers;
class TiendaManager extends BaseManager {
    public function getRules()
    {
        $rules = [          'nombreTienda'=>'',
                            'razonSocial'=>'',
                            'ruc'=>'',
                            'direccion'=>'',
                            'distrito'=>'',
                            'provincia'=>'',
                            'departamento'=>'',
                            'pais'=>'',
                            'email'=>'',
                            'telMovil'=>'',
                            'telFijo'=>'',
                            'webSite'=>'' ];
        return $rules;
    }}