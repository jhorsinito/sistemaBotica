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
    }
    public function traerLaboratorios()
    {
        $laboratorios = $this->laboratorioRepo->traerLaboratorios();
        return response()->json($laboratorios);
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

        $laboratorio = $this->laboratorioRepo->getModel();    
        $manager = new LaboratorioManager($laboratorio,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$laboratorio->nombre]);
    }

    public function find($id)
    {
        $laboratorio = $this->laboratorioRepo->find($id);
        return response()->json($laboratorio);
    }

    public function edit(Request $request)
    {
        $laboratorio = $this->laboratorioRepo->find($request->id);
        $manager = new LaboratorioManager($laboratorio,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$laboratorio->nombre]);
    }

    public function destroy(Request $request)
    {
        $laboratorio= $this->laboratorioRepo->find($request->id);
        $laboratorio->delete();
        return response()->json(['estado'=>true, 'nombre'=>$laboratorio->nombre]);
    }

    public function search($q)
    {
        $laboratorios = $this->laboratorioRepo->search($q);

        return response()->json($laboratorios);
    }
}