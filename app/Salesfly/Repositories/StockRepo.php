<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Stock;

class StockRepo extends BaseRepo{
    
    public function getModel()
    {
        return new Stock;
    }
    
   public function encontrar($vari){
        $stock=Stock::where("variant_id","=",$vari);
        return $stock;
    }
} 