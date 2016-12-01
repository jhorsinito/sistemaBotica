<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Venta;
class AlmacenRepo extends BaseRepo{

    public function getModel()
    {
        return new Venta;
    }
    public function search($q)
    {
        $venta =Venta::where('nombreVenta','like', $q.'%')
                    ->orwhere('descripcion','like', $q.'%')
                    ->paginate(15);
        return $venta;
    }
    
    public function paginaterepo($c){
        $venta = Venta::with('tienda')->paginate($c);
        $venta = Venta::with(array('tienda'=>function($query){
            $query->select('id','nombreTienda');
        }))->paginate($c);
        return $venta;
    }
}
