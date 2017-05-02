<?php
namespace Salesfly\Salesfly\Managers;
class ClienteManager extends BaseManager {
    public function getRules()
    {
        $rules = [          'nombreCliente'=>'required', 
                            'empresa', 
                            'direccion', 
                            'ruc', 
                            'dni',
                            'codigo',
                            'fechaNac',
                            'genero', 
                            'tel_fijo',
                            'tel_movil',
                            'email', 
                            'webSite', 
                             'notas'];
                            ];
        return $rules;
    }}