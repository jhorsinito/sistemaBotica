<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Mockery\Matcher\Type;
use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;

use Salesfly\Salesfly\Repositories\VariantRepo;
use Salesfly\Salesfly\Managers\VariantManager;

use Salesfly\Salesfly\Entities\Variant;
use Salesfly\Salesfly\Entities\Product;

class VariantsController extends Controller
{
    protected $variantRepo;

    public function __construct(VariantRepo $variantRepo)
    {
        $this->variantRepo = $variantRepo;
    }
    public function find($id)
    {
        $variants = $this->variantRepo->find($id);
        return response()->json($variants);
    }

    public function paginatep(){ //->with(['store'])
        $variants = $this->variantRepo->detPre();
        return response()->json($variants);
    }


   
    public function findVariant($id)
    {
        $variant = $this->variantRepo->select($id);
        return response()->json($variant);
    }



    public function variants($product_id){

        $product = Product::find($product_id);
        if($product->hasVariants == 1) {
            $variants = $product->variants->load(['detAtr' => function ($query) {
                $query->orderBy('atribute_id', 'asc');
            },'product']);


            //$variants = $product->variants->load('detAtr','product');


            //foreach($variants as $variant) {
            //    print_r($variant->detAtr->toJson());
            //}
            //die();
            //dd($variants->toArray());

        }else{
            $variants = null;
        }

        //$variants = Variant::with('atributes')->get();


        return response()->json($variants);
        //return response()->json(Product::find(2)->with('brand')->get());
    }

}
