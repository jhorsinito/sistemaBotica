<?php
namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\alumRepo;
use Salesfly\Salesfly\Managers\alumManager;
 class alumController extends Controller{
 	protected $alumRepo;
 	public function __construct(alumRepo $storeRepo)
    {
        $this->alumRepo = $storeRepo;
    }
    public function all()
    {
        $stores = $this->alumRepo->paginate(3);
        return response()->json($stores);
        //var_dump($stores);
    }
  public function mostrar(){
        $alumno = Estudiante::all();
        return response()->json($alumno);
  	   //return "hola";
    }
    public function find($id)
    {
        $store = $this->alumRepo->find($id);
        return response()->json($store);
    }
 }