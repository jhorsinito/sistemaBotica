<?php

namespace Salesfly\Salesfly\Repositories;

use Salesfly\Salesfly\Entities\Product;

class ProductRepo extends BaseRepo{

    public function getModel(){
        return new Product;
    }

    public function search($q){

        //$products = Product::where()

    }

    public function paginate($qantity){
        $products = $this->getModel()->with('material','station','brand','type')->paginate($qantity);
        return $products;
    }

}