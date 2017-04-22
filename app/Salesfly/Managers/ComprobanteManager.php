<?php
namespace Salesfly\Salesfly\Managers;
class ComprobanteManager extends BaseManager {

    public function getRules()
    {
        $rules = [ 'nombreComprobante'=> 'required',
            		'descripcion'=> ''
                  ];
        return $rules;
    }}