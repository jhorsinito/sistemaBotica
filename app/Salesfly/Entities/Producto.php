<?php
namespace Salesfly\Salesfly\Entities;
class Producto extends \Eloquent {
	protected $table = 'productos';
    
    protected $fillable = ['nombreTienda',
    						'razonSocial',
    						'ruc',
    						'direccion',
    						'distrito',
    						'provincia',
    						'departamento',
    						'pais',
    						'email',
    						'telMovil',
    						'telFijo',
    						'webSite'];

    
}