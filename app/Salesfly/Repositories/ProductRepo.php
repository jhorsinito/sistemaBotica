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

        $products = Product::leftjoin('brands','products.brand_id','=','brands.id')
                            ->leftjoin('types','products.type_id','=','types.id')
                            ->leftjoin('variants','products.id','=','variants.product_id')
                            ->leftjoin('detPres','variants.id','=','detPres.variant_id')
                            ->leftjoin('presentation','detPres.presentation_id','=','presentation.id')
                            ->leftjoin('stock','stock.variant_id','=','variants.id')
                            ->select(\DB::raw('DISTINCT(products.id) as proId'),'products.codigo as proCodigo','products.nombre as proNombre',
                              'variants.suppPri as varPrice','variants.price as precioProducto',
                               'brands.nombre as braNombre','products.hasVariants as TieneVariante','products.hasVariants as proHasVar','types.nombre as typNombre','products.created_at as proCreado',
                              'products.quantVar as proQuantvar',\DB::raw('(SELECT sum(stock.stockActual)
FROM products
INNER JOIN variants ON products.id = variants.product_id
INNER JOIN stock ON variants.id = stock.variant_id
WHERE products.id = proId) as stoStockActual'),
                                \DB::raw('( SELECT detPres.price
FROM products
INNER JOIN variants ON products.id = variants.product_id
INNER JOIN detPres ON variants.id = detPres.variant_id
INNER JOIN presentation ON detPres.presentation_id = presentation.id
WHERE products.presentation_base = presentation.id and products.id = proId and products.hasVariants = false ) as detPresPri'))
                            //->having()
                            ->groupBy('products.id')
                            ->paginate($qantity);

        return $products;

    }

    public function find($id){
        $oProduct = Product::find($id);

        $product = $oProduct->load(['station','type','brand','material']);

        return $product;
    }

    public function pag()
    {

        /*$products = Product::with(['variants' => function ($query) {
            $query->join('detPres', 'variants.id', '=', 'detPres.variant_id')
                ->join('presentation','presentation.id','=','detPres.presentation_id')
                //->join('productss','products.presentation_base','=','presentation.id')
                //->select('detPres.price')
                //->first();
                ->where('presentation.id', 'products.presentation_base');
        }])->get();
        */



        //$products = Product::with(['brand'])->get();

        //return $products;
        /*$variants = $product->variants->load(['detAtr' => function ($query) {
            $query->orderBy('atribute_id', 'asc');
        },'product','detPre' => function($query) use ($product){
            $query->join('presentation','presentation.id','=','detPres.presentation_id')
                ->where('presentation.id',$product->presentation_base);
        },'stock' => function($query){
            $query->where('warehouse_id',1);
        }]);
        */


    }

}