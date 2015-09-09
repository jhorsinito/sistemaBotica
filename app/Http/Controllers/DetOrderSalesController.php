<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetOrderSaleRepo;
use Salesfly\Salesfly\Managers\DetSaleManager;

class DetOrderSalesController extends Controller {

    protected $detOrderSaleRepo;

    public function __construct(DetOrderSaleRepo $detOrderSaleRepo)
    {
        $this->detOrderSaleRepo = $detOrderSaleRepo;
    }

    

    public function searchDetalle($id)
    {
        //$q = Input::get('q');
        $detorderSale = $this->detOrderSaleRepo->searchDetalle($id);

        return response()->json($detorderSale);
    } 
}