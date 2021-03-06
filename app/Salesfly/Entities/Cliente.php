<?php
namespace Salesfly\Salesfly\Entities;

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
                             'notas'];

    public function venta()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Venta');
    }
}