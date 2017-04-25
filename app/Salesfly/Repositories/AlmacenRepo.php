<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Almacen;
class AlmacenRepo extends BaseRepo{

    public function getModel()
    {
        return new Almacen;
    }
    public function search($q)
    {
        $almacen =Almacen::where('nombreAlmacen','like', $q.'%')
                    ->orwhere('descripcion','like', $q.'%')
                    ->paginate(15);
        return $almacen;
    }

    public function allAlmacenes()
    {
        $almacen =Almacen::orderBy('nombreAlmacen', 'asc')
                        ->get();
        return $almacen;
    }

    
    public function paginaterepo($c){
        $almacen = Almacen::with('tienda')->paginate($c);
        $almacen = Almacen::with(array('tienda'=>function($query){
            $query->select('id','nombreTienda');
        }))->paginate($c);
        return $almacen;
    }

}

}
