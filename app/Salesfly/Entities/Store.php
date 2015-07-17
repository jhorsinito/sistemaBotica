<?php
namespace Salesfly\Salesfly\Entities;

class Store extends \Eloquent {

    protected $table = 'stores';
    
    protected $fillable = [ 
                    'nombreTienda',
                    'razonSocial',
                    'ruc',
                    'direccion',
                    'distrito',
                    'provincia',
                    'departamento',
                    'email',
                    'website'];

}