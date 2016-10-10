<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\MarcaRepo;
use Salesfly\Salesfly\Managers\MarcaManager;

class MarcasController extends Controller {

    protected $marcaRepo;

    public function __construct(MarcaRepo $marcaRepo)
    {
        $this->marcaRepo = $marcaRepo;
    }

    public function index()
    {
        return View('marcas.index');
    }

    public function all()
    {
        $marcas = $this->marcaRepo->paginate(15);
        return response()->json($marcas);
        //var_dump($marcas);
    }

    public function paginatep(){
        $marcas = $this->marcaRepo->paginate(15);
        return response()->json($marcas);
    }


    public function form_create()
    {
        return View('marcas.form_create');
    }

    public function form_edit()
    {
        return View('marcas.form_edit');
    }

    public function create(Request $request)
    {
        $marcas = $this->marcaRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new MarcaManager($marcas,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.brand',$brand->all());

        return response()->json(['estado'=>true, 'nombre'=>$marcas->nombre]);
    }

    public function find($id)
    {
        $brand = $this->marcaRepo->find($id);
        return response()->json($brand);
    }

    public function edit(Request $request)
    {
        $brand = $this->marcaRepo->find($request->id);
        //var_dump($brand);
        //die(); 
        $manager = new MarcaManager($brand,$request->all());
        $manager->save();

        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true, 'nombre'=>$brand->nombre]);
    }

    public function destroy(Request $request)
    {
        $brand= $this->marcaRepo->find($request->id);
        $brand->delete();
        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true, 'nombre'=>$brand->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $marcas = $this->marcaRepo->search($q);

        return response()->json($marcas);
    }
    public function validaBrandname($text){
        
        $marcas = $this->marcaRepo->validarNoRepit($text);

        return response()->json($marcas);
    }
}