<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;

use Salesfly\Salesfly\Repositories\PresentationRepo;
use Salesfly\Salesfly\Managers\PresentationManager;




class PresentationsController extends Controller
{
    protected $presentationRepo;

    public function __construct(PresentationRepo $presentationRepo)
    {
        $this->presentationRepo = $presentationRepo;
        $this->middleware('auth');
        //$this->middleware('role:admin');
    }



    public function all()
    {
        $presentations = $this->presentationRepo->all();
        return response()->json($presentations);
        //var_dump($customers);
    }


}
