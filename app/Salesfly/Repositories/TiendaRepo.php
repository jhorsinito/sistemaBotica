<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Tienda;
class TiendaRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Tienda;
    }
    public function search($q)
    {
        $tienda =Tienda::where('nombreTienda','like', $q.'%')
                    ->orwhere('razonSocial','like', $q.'%')
                    ->orwhere('ruc','like', $q.'%')
                    ->paginate(15);
        return $tienda;
    }
    public function allTiendas()
    {
        $tienda =Tienda::orderBy('nombreTienda', 'asc')
                        ->get();
        return $tienda;
    }
     
} 