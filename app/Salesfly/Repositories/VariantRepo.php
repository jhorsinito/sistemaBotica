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
        $variants=Variant::join('detAtr','detAtr.variant_id','=','variants.id')
        //->join('atributes','detAtri.atribute_id','=','atribute.id')
       // ->join('brands','products.brand_id','=','brands.id')->groupBy('products.id')
       // ->join('stations','products.station_id','=','stations.id')
        ->select('variants.precio ','detAtr.decripcion ')->get();
        return $variants;
        
    }
     public function select($id){
       
        $variants=Variant::join('detAtr','variants.id','=','detAtr.variant_id')->where('variants.product_id','=',$id)
        ->select('variants.*','detAtr.descripcion as Atrdescri')->get();
        return $variants;
    }  
    public function detPre(){
          $variants = Variant::with(['detAtr' => function ($query) {
                //$query->select('*');
            }])->paginate();
        
        return $variants;
    }

    //public function byForeignKey($id){

    //}

}