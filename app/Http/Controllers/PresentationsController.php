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
    public function findVariant($id){
        $presentations = $this->presentationRepo->select($id);
        return response()->json($presentations);
    }

    //todas las presentaciones base.
    public function all_base()
    {
        $presentations = $this->presentationRepo->all_base();
        return response()->json($presentations);
        //var_dump($customers);
    }
    public function all_by_base($id)
    {
        $presentations = $this->presentationRepo->all_by_base($id);
        return response()->json($presentations);
    }
}
