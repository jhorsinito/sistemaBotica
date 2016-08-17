<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\ProfesionRepo;
use Salesfly\Salesfly\Managers\ProfesionManager;
 
class ProfesionesController extends Controller {

    protected $profesionRepo;

    public function __construct(ProfesionRepo $profesionRepo)
    {
        $this->profesionRepo = $profesionRepo;
    }

    public function index()
    {
        return View('profesiones.index');
    }

    public function all()
    {
        $profesiones = $this->profesionRepo->paginate(15);
        return response()->json($profesiones);
    }

    public function paginatep(){
        $profesiones = $this->profesionRepo->paginate(15);
        return response()->json($profesiones);
    }


    public function form_create()
    {
        return View('profesiones.form_create');
    }

    public function form_edit()
    {
        return View('profesiones.form_edit');
    }

    public function create(Request $request)
    {
        $profesiones = $this->profesionRepo->getModel();
        $manager = new ProfesionManager($profesiones,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$profesiones->nombre]);
    }

    public function find($id)
    {
        $station = $this->profesionRepo->find($id);
        return response()->json($station);
    }

    public function edit(Request $request)
    {
        $station = $this->profesionRepo->find($request->id);

        $manager = new ProfesionManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->profesionRepo->find($request->id);
        $station->delete();
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        $profesiones = $this->profesionRepo->search($q);

        return response()->json($profesiones);
    }
}