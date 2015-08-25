<?php

namespace Salesfly\Salesfly\Repositories;

use Salesfly\Salesfly\Entities\Product;
use Salesfly\Salesfly\Entities\Variant;

class ProductRepo extends BaseRepo{

    public function getModel(){
        return new Product;
    }

    public function search($q)
    {
        $promotion =Product::select('id','nombre','codigo','estado')->where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $promotion;
    }

    public function paginate($qantity){
        //$products = $this->getModel()->with('brand','type')->_variant->paginate($qantity);
        //$products = Product::find(1)->variant; trae 1
        //$products = Product::find(1)->variants; trae todos
        //$products = $this->getModel()->with('brand','type','variant')->paginate($qantity);
        //$productsNovariants = Product::join('brands','products.brand_id','=','brands.id')
       //                    ->join('types','products.type_id','=','types.id')
         //                   ->join('variants','products.id','=','variants.product_id')
        //                    ->where('products.hasVariants',false)
         //                   ->select('products.id as proId','products.codigo as proCodigo','products.nombre as proNombre','variants.price as varPrice',
         //                       'brands.nombre as braNombre','types.nombre as typNombre','products.created_at as proCreado',
         //                       \DB::raw('"0" as variantes'),\DB::raw('"0" as stoStockActual') )
         //                   ->paginate($qantity);
                            //->get();

        //$productsSivariants =  Product::join('brands','products.brand_id','=','brands.id')
          //                  ->join('types','products.type_id','=','types.id')
          //                  ->join('variants','products.id','=','variants.product_id')
          //                  ->where('products.hasVariants',true)
          //                  ->select(\DB::raw('DISTINCT(products.id) as proId'),'products.codigo as proCodigo','products.nombre as proNombre','variants.price as varPrice',
          //                      'brands.nombre as braNombre','types.nombre as typNombre','products.created_at as proCreado',
          //                  \DB::raw('COUNT(variants.id) as variantes'),\DB::raw('"0" as stoStockActual') )
          //                  ->groupBy('products.id')
          //                  ->paginate($qantity);
                            //->get();

        //$products = array_merge($productsNovariants->toArray(),$productsSivariants->toArray());

        //$pp = $productsNovariants->toArray();
        //$pp2 = $productsSivariants->toArray();
        //$products = array_merge($pp['data'],$pp2['data']);
        //print_r($products);
        //die();

        //return $products;

        $products = Product::join('brands','products.brand_id','=','brands.id')
                            ->join('types','products.type_id','=','types.id')
                            ->leftjoin('variants','products.id','=','variants.product_id')
                            ->select(\DB::raw('DISTINCT(products.id) as proId'),'products.codigo as proCodigo','products.nombre as proNombre',
                              'variants.suppPri as varPrice','variants.price as precioProducto',
                               'brands.nombre as braNombre','products.hasVariants as TieneVariante','types.nombre as typNombre','products.created_at as proCreado',
                              'products.quantVar as proQuantvar',\DB::raw('"0" as stoStockActual'))
                            ->groupBy('products.id')
                            ->paginate($qantity);

        return $products;
    }

    public function find($id){
        $product = Product::find($id)->load('brand','material','station','type');

        return $product;
    }


    public function misDatos($store,$were,$q){
      $datos = \DB::table('products')->leftjoin('materials','products.material_id','=','materials.id')
                           ->leftjoin('variants','products.id','=','variants.product_id')
                            ->leftjoin('stock','variants.id','=','stock.variant_id')
                            ->leftjoin('warehouses','warehouses.id','=','stock.warehouse_id')
                            ->leftjoin('stores','stores.id','=','warehouses.store_id')
                            ->leftjoin('presentation as T1','T1.id','=','products.presentation_base')
                            ->join('detPres','detPres.variant_id','=','variants.id')
                            ->join('presentation as T2','T2.id','=','detPres.presentation_id')
                            ->select(\DB::raw('variants.sku as SKU ,detPres.id as detPre_id,products.nombre as NombreProducto,materials.nombre as Material,
                              warehouses.nombre as Almacen,stock.stockActual as Stock,detPres.price as precioProducto,
                              variants.id as vari , CONCAT(products.nombre,"/",(SELECT GROUP_CONCAT(atributes.nombre SEPARATOR "/") FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=vari
                                GROUP BY variants.id)) as NombreAtributos , T1.nombre as Base, T2.nombre as Presentacion, products.presentation_base, warehouses.id as idAlmacen'))
                             
                              //'T1.nombre as Base')
                            ->where('stores.id','=',$store)
                            ->where('warehouses.id','=',$were)
                            ->where('products.nombre','like', $q.'%')
                            ->where('T2.base','like','%%')
                            ->groupBy('variants.id')
                            ->get();
            return $datos;
    }
    public function misDatosVariantes($store,$were,$q){
      $datos = \DB::table('products')->leftjoin('materials','products.material_id','=','materials.id')
                           ->leftjoin('variants','products.id','=','variants.product_id')
                            ->leftjoin('stock','variants.id','=','stock.variant_id')
                            ->leftjoin('warehouses','warehouses.id','=','stock.warehouse_id')
                            ->leftjoin('stores','stores.id','=','warehouses.store_id')
                            ->leftjoin('presentation as T1','T1.id','=','products.presentation_base')
                            ->join('detPres','detPres.variant_id','=','variants.id')
                            ->join('presentation as T2','T2.id','=','detPres.presentation_id')
                            ->select(\DB::raw('variants.sku as SKU ,detPres.id as detPre_id,products.nombre as NombreProducto,materials.nombre as Material,
                              warehouses.nombre as Almacen,stock.stockActual as Stock,detPres.price as precioProducto,
                              variants.id as vari , CONCAT(products.nombre,"/",(SELECT GROUP_CONCAT(atributes.nombre SEPARATOR "/") FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=vari
                                GROUP BY variants.id)) as NombreAtributos , T1.nombre as Base, T2.nombre as Presentacion, products.presentation_base, warehouses.id as idAlmacen
                              ,T2.base as base'))
                             
                              //'T1.nombre as Base')
                            ->where('stores.id','=',$store)
                            ->where('warehouses.id','=',$were)
                            //->where('products.nombre','like', $q.'%')
                            ->where('T2.base','like','%%')
                            //->groupBy('variants.id')
                            ->where('variants.id','=',$q)
                            ->get();
            return $datos;
    }
}