<?php

namespace Salesfly\Salesfly\Repositories;

use Salesfly\Salesfly\Entities\Variant;

class VariantRepo extends BaseRepo{

    public function getModel(){
        return new Variant;
    }

  /* public function paginaterepo($c){
        //$warehouses = Warehouse::with('store')->paginate($c);
        $variants = Variant::with(array('product'=>function($query){
            $query->select('id','nombre');
        }))->paginate($c);
        return $variants;
    } */

     public function paginaterepo($c){
        //$warehouses = Warehouse::with('store')->paginate($c);
        $variants=Variant::join('products','variants.product_id','=','products.id')
        ->join('materials','products.material_id','=','materials.id')
        ->join('brands','products.brand_id','=','brands.id')->groupBy('products.id')
        ->join('stations','products.station_id','=','stations.id')
        ->select('products.id as idproducto','variants.price as precio','products.nombre as nombrep',
            'brands.nombre as nombreB','materials.nombre as nombreM','stations.nombre as nombreS')->paginate($c);
        return $variants;
        
    }
     public function select($id){
        //$warehouses = Warehouse::with('store')->paginate($c);
        $variants=Variant::join('products','variants.product_id','=','products.id')
        ->join('materials','products.material_id','=','materials.id')
        ->join('brands','products.brand_id','=','brands.id')->where('variants.product_id','=',$id)
        ->join('stations','products.station_id','=','stations.id')
        ->select('products.id as idproducto','variants.price as precio','products.nombre as nombrep',
            'brands.nombre as nombreB','materials.nombre as nombreM','stations.nombre as nombreS')->get();
        return $variants;
        
    }  

}