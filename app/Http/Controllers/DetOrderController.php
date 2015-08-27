<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetOrderRepo;
use Salesfly\Salesfly\Managers\DetOrderManager;

class DetOrderController extends Controller {

    protected $detOrderRepo;

    public function __construct(DetOrderRepo $detOrderRepo)
    {
        $this->detOrderRepo = $detOrderRepo;
    }

    

    public function searchDetalle($id)
    {
        //$q = Input::get('q');
        $detOrder = $this->detOrderRepo->searchDetalle($id);

        return response()->json($detOrder);
    }
}