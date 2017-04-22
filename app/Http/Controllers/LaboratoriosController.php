<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\LaboratorioRepo;
use Salesfly\Salesfly\Managers\LaboratorioManager;

class LaboratoriosController extends Controller {

    protected $laboratorioRepo;

    public function __construct(LaboratorioRepo $laboratorioRepo)
    {
        $this->laboratorioRepo = $laboratorioRepo;
    }

    public function index()
    {
        return View('laboratorios.index');
    }

    public function all()
    {
        $laboratorios = $this->laboratorioRepo->paginate(15);
        return response()->json($laboratorios);
        //var_dump($laboratorios);
    }

    public function paginatep(){
        $laboratorios = $this->laboratorioRepo->paginate(15);
        return response()->json($laboratorios);
    }


    public function form_create()
    {
        return View('laboratorios.form_create');
    }

    public function form_edit()
    {
        return View('laboratorios.form_edit');
    }

    public function create(Request $request)
    {
        $laboratorios = $this->laboratorioRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new LaboratorioManager($laboratorios,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.brand',$brand->all());

        return response()->json(['estado'=>true, 'nombre'=>$laboratorios->nombre]);
    }

    public function find($id)
    {
        $laboratorio = $this->laboratorioRepo->find($id);
        return response()->json($laboratorio);
    }

    public function edit(Request $request)
    {
        $laboratorio = $this->laboratorioRepo->find($request->id);
        //var_dump($brand);
        //die(); 
        $manager = new LaboratorioManager($laboratorio,$request->all());
        $manager->save();

        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true, 'nombre'=>$laboratorio->nombre]);
    }

    public function destroy(Request $request)
    {
        $laboratorio= $this->laboratorioRepo->find($request->id);
        $laboratorio->delete();
        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true, 'nombre'=>$laboratorio->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $laboratorios = $this->laboratorioRepo->search($q);

        return response()->json($laboratorios);
    }
    public function validaLaboratorioname($text){
        
        $laboratorios = $this->laboratorioRepo->validarNoRepit($text);

        return response()->json($laboratorios);
    }
}