<?php
namespace Salesfly\Salesfly\Entities;
class Tienda extends \Eloquent {
    protected $table = 'tiendas';
    
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

    public function almacen()
    {
        return $this-> hasmany(Almacen::class);
    }

     public function caja()
    {
        return $this-> hasmany(Caja::class);
    }
