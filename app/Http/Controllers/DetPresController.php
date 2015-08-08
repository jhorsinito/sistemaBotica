<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;
use Salesfly\Salesfly\Repositories\DetPresRepo;

class DetPresController extends Controller
{
    protected $detPresRepo;

    public function __construct(DetPresRepo $detPresRepo)
    {
        $this->detPresRepo = $detPresRepo;
        $this->middleware('auth');
        //$this->middleware('role:admin');
    }



    public function all()
    {
        $detPres = $this->detPresRepo->all();
        return response()->json($detPres);
        //var_dump($customers);
    }
}
