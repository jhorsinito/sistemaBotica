<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Stock;

class StockRepo extends BaseRepo{

    public function getModel()
    {
        return new Stock;
    }


}