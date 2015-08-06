<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\VariantRepo;
use Salesfly\Salesfly\Managers\VariantManager;

class VariantsController extends Controller {

    protected $variantRepo;

    public function __construct(VariantRepo $variantRepo)
    {
        $this->variantRepo = $variantRepo;
    }


    public function paginatep(){ //->with(['store'])
        $variants = $this->variantRepo->paginaterepo(15);
        //$variants = $this->variantRepo->with(['store'])->paginate(15);
        return response()->json($variants);
    }


   
    public function findVariant($id)
    {
        $variant = $this->variantRepo->select$id);
        return response()->json($variant);
    }

    


    public function select(){
        $variant = $this->variantRepo->all();
        return response()->json($variant);
    }

}