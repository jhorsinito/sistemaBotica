<?php
namespace Salesfly\Salesfly\Managers;
class ClienteManager extends BaseManager {
    public function getRules()
    {
        $rules = [  		'nombreCliente'=>'required', 
    						'empresa', 
    						'direccion', 
    						'ruc', 
    						'dni'=>'required',
    						'codigo',
    						'fechaNac',
    						'genero', 
    						'tel_fijo',
    						'tel_movil',
    						'email', 
    						'webSite', 
    						'pais', 
    						'departamento', 
    						'provincia', 
    						'distrito', 
    						'notas'
    						];
        return $rules;
    }}