<?php
namespace Salesfly\Salesfly\Entities;
class Proveedor extends \Eloquent {
	protected $table = 'proveedores';
    
    protected $fillable = ['nombreProveedor',
                            'tipoDocumento_id',
                            'numDocumento',
    						'direccion',
    						'numCuenta',
    						'telefonos',
    						'email',
    						'webSite'];

    public function tipoDocumento()
    {
        return $this-> hasmany(TipoDocumento::class);
    }

    public function compra()
    {
        return $this-> hasmany(Compra::class);
    }
}