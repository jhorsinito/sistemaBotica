<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetGrupoFarmaceuticoVarianteRepo;
use Salesfly\Salesfly\Managers\DetGrupoFarmaceuticoVarianteManager;

class DetGrupoFarmaceuticoVarianteController extends Controller {

    protected $detGrupoFarmaceuticoVarianteRepo;

    public function __construct(DetGrupoFarmaceuticoVarianteRepo $detGrupoFarmaceuticoVarianteRepo)
    {
        $this->detGrupoFarmaceuticoVarianteRepo = $detGrupoFarmaceuticoVarianteRepo;
    }

    public function index()
    {
        return View('detGrupoFarmaceuticos.index');
    }

    public function all()
    {
        $detGrupoFarmaceuticos = $this->detGrupoFarmaceuticoVarianteRepo->paginate(15);
        return response()->json($detGrupoFarmaceuticos);
    }
    public function cargarDetGrupoFarmaceuticoVariantes($dato)
    {
        $detGrupoFarmaceuticos = $this->detGrupoFarmaceuticoVarianteRepo->cargarDetGrupoFarmaceuticoVariantes($dato);
        return response()->json($detGrupoFarmaceuticos);
    }

    public function paginatep(){
        $detGrupoFarmaceuticos = $this->detGrupoFarmaceuticoVarianteRepo->paginate(15);
        return response()->json($detGrupoFarmaceuticos);
    }


    public function form_create()
    {
        return View('detGrupoFarmaceuticos.form_create');
    }

    public function form_edit()
    {
        return View('detGrupoFarmaceuticos.form_edit');
    }

    public function create(Request $request)
    {

        $detGrupoFarmaceutico = $this->detGrupoFarmaceuticoVarianteRepo->getModel();    
        $manager = new DetGrupoFarmaceuticoVarianteManager($detGrupoFarmaceutico,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$detGrupoFarmaceutico->nombre]);
    }

    public function find($id)
    {
        $detGrupoFarmaceutico = $this->detGrupoFarmaceuticoVarianteRepo->find($id);
        return response()->json($detGrupoFarmaceutico);
    }

    public function edit(Request $request)
    {
        $detGrupoFarmaceutico = $this->detGrupoFarmaceuticoVarianteRepo->find($request->id);
        $manager = new DetGrupoFarmaceuticoVarianteManager($detGrupoFarmaceutico,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$detGrupoFarmaceutico->nombre]);
    }

    public function destroy(Request $request)
    {
        $detGrupoFarmaceutico= $this->detGrupoFarmaceuticoVarianteRepo->find($request->id);
        $detGrupoFarmaceutico->delete();
        return response()->json(['estado'=>true, 'nombre'=>$detGrupoFarmaceutico->nombre]);
    }

    public function search($q)
    {
        $detGrupoFarmaceuticos = $this->detGrupoFarmaceuticoVarianteRepo->search($q);

        return response()->json($detGrupoFarmaceuticos);
    }
}