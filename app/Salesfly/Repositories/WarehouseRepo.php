<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Warehouse;

class WarehouseRepo extends BaseRepo{
    public function getModel()
    {
        return new Warehouse;
    }

    public function search($q)
    {
        $warehouses =Warehouse::where('nombre','like', $q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $warehouses;
    }
    public function paginaterepo($c){
        //$warehouses = Warehouse::with('store')->paginate($c);
        $warehouses = Warehouse::with(array('store'=>function($query){
            $query->select('id','nombreTienda');
        }))->paginate($c);
        return $warehouses;
    }
}