<?php
namespace Salesfly\Salesfly\Managers;
class TipoDocumentoManager extends BaseManager {
    public function getRules()
    {
        $rules = [ 'nombreDocumento'=>'required',
    			   'descripcion'=>''
    			 ];
    			 
        return $rules;
    }}