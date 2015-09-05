<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\InputStock;

class InputStockRepo extends BaseRepo{
    public function getModel()
    {
        return new InputStock;
    }

    public function search($q)
    {
        $brands =InputStock::where('nombre','like', $q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $brands;
    }
    public function select($id){
       $InputStock=InputStock::join("variants","variants.id","=","inputStocks.variant_id")
                            ->select(\DB::raw("inputStocks.descripcion,inputStocks.fecha,inputStocks.cantidad_llegado,variants.codigo,warehouses.nombre"))
                            ->where("inputStocks.headInputStock_id")
                            ->groupBy("inputStocks.id")->paginate(15);
        return $InputStock;
    }
}