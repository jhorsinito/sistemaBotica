<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\TipoProducto;

class TipoProductoRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new TipoProducto;
    }

    public function search($q)
    {
        $tipoProductos =TipoProducto::where('nombre','like', $q.'%')
                    ->paginate(15);
        return $tipoProductos;
    }
} 