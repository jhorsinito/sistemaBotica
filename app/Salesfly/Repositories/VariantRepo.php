<?php

namespace Salesfly\Salesfly\Repositories;

use Salesfly\Salesfly\Entities\Variant;

class VariantRepo extends BaseRepo{

    public function getModel(){
        return new Variant;
    }

    public function search($q){

        //$products = Product::where()

    }

    public function paginate($qantity){
        //$variants = $this->getModel()->with('material','station','brand','type')->paginate($qantity);
        //return $variants;
    }

}