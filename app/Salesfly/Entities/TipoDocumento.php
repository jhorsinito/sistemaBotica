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
class Cliente extends \Eloquent {
    
    protected $table = 'clientes';
    
    protected $fillable = [ 'nombreCliente', 
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
                            'pais', 
                            'departamento', 
                            'provincia', 
                            'distrito', 
                            'notas'];

    public function venta()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Venta');
    }
}