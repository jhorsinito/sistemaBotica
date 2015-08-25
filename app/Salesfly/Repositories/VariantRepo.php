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
     public function findVariant($id){
       
        $variants=Variant::join('detAtr','variants.id','=','detAtr.variant_id')
                        ->join('detPres','detPres.variant_id','=','variants.id')
                        ->join('presentation','detPres.presentation_id','=','presentation.id')
                        ->leftjoin('equiv','equiv.preFin_id','=','presentation.id')
                        ->where('detPres.id','=',$id)
        ->select(\DB::raw('variants.*,detAtr.descripcion as Atrdescri,presentation.nombre,
            equiv.cant as equivalencia,equiv.preBase_id as base'))->groupBy('variants.id')->first();
       $variants->preBase=Variant::join('detPres','detPres.variant_id','=','variants.id')
                        ->join('presentation','detPres.presentation_id','=','presentation.id')
                        ->leftjoin('equiv','equiv.preFin_id','=','presentation.id')
                        ->where('presentation.id','=',$variants->base)
                        ->select('presentation.shortname')->first();
        return $variants;
    } 
    public function uatocomplit(){
       
        $variants=Variant::join('detAtr','variants.id','=','detAtr.variant_id')
                        ->join('products','products.id','=','variants.product_id')
        ->select(\DB::raw('variants.*,variants.id as varid,products.nombre as nombre,detAtr.descripcion as descripcion,
            (SELECT GROUP_CONCAT(detAtr.descripcion SEPARATOR "-") FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=varid
                                GROUP BY variants.id) as NombreAtributos'))->groupBy('variants.id')->paginate(15);
        return $variants;
    }   
  

}