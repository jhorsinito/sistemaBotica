<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\GruposFarmacologicoRepo;
use Salesfly\Salesfly\Managers\GruposFarmacologicoManager;

class GruposFarmacologicoController extends Controller {

    protected $gruposFarmacologicoRepo;

    public function __construct(GruposFarmacologicoRepo $gruposFarmacologicoRepo)
    {
        $this->gruposFarmacologicoRepo = $gruposFarmacologicoRepo;
    }

    public function index()
    {
        return View('gruposFarmacologicos.index');
    }

    public function all()
    {
        $gruposFarmacologicos = $this->gruposFarmacologicoRepo->paginate(15);
        return response()->json($gruposFarmacologicos);
    }
    public function buscarGrupoFarmaceutico($dato)
    {
        $gruposFarmacologicos = $this->gruposFarmacologicoRepo->buscarGrupoFarmaceutico($dato);
        return response()->json($gruposFarmacologicos);
    }

    public function paginatep(){
        $gruposFarmacologicos = $this->gruposFarmacologicoRepo->paginate(15);
        return response()->json($gruposFarmacologicos);
    }


    public function form_create()
    {
        return View('gruposFarmacologicos.form_create');
    }

    public function form_edit()
    {
        return View('gruposFarmacologicos.form_edit');
    }

    public function create(Request $request)
    {

        $gruposFarmacologico = $this->gruposFarmacologicoRepo->getModel();    
        $manager = new GruposFarmacologicoManager($gruposFarmacologico,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$gruposFarmacologico->nombre]);
    }

    public function find($id)
    {
        $gruposFarmacologico = $this->gruposFarmacologicoRepo->find($id);
        return response()->json($gruposFarmacologico);
    }

    public function edit(Request $request)
    {
        $gruposFarmacologico = $this->gruposFarmacologicoRepo->find($request->id);
        $manager = new GruposFarmacologicoManager($gruposFarmacologico,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$gruposFarmacologico->nombre]);
    }

    public function destroy(Request $request)
    {
        $gruposFarmacologico= $this->gruposFarmacologicoRepo->find($request->id);
        $gruposFarmacologico->delete();
        return response()->json(['estado'=>true, 'nombre'=>$gruposFarmacologico->nombre]);
    }

    public function search($q)
    {
        $gruposFarmacologicos = $this->gruposFarmacologicoRepo->search($q);

        return response()->json($gruposFarmacologicos);
    }
}