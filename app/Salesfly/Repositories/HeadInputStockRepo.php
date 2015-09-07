<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\HeadInputStock;

class HeadInputStockRepo extends BaseRepo{
    public function getModel()
    {
        return new HeadInputStock;
    }

    public function search($q)
    {
        $brands =InputStock::where('nombre','like', $q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $brands;
    }
    public function select(){
       $headInputStock=HeadInputStock::join("warehouses","warehouses.id","=","headInputStocks.warehouses_id")->join('users','users.id','=','headInputStocks.user_id')
                            ->select(\DB::raw("headInputStocks.*,warehouses.nombre,users.name as nombreUser"))
                            ->groupBy("headInputStocks.id")->paginate(15);
        return $headInputStock;
    }
}