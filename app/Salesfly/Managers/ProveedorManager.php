<?php
namespace Salesfly\Salesfly\Managers;
class ProveedorManager extends BaseManager {
    public function getRules()
    {
        $rules = [  		'nombreProveedor'=>'required',
                            'tipoDocumento_id'=>'',
                            'numDocumento'=>'',
    						'direccion'=>'',
    						'numCuenta'=>'',
    						'telefonos'=>'',
    						'email'=>'required',
    						'webSite'=>''
    						
                             ];
        return $rules;
    }}