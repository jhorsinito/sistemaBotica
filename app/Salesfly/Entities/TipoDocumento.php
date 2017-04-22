<?php
namespace Salesfly\Salesfly\Entities;

class TipoDocumento extends \Eloquent {
    
    protected $table = 'tipoDocumentos';
    
    protected $fillable = [ 'nombreDocumento', 
                            'descripcion'
                          ];


    public function proveedor()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Proveedor');
    }
}