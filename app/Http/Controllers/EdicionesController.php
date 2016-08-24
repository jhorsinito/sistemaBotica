<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\EdicionRepo;
use Salesfly\Salesfly\Managers\EdicionManager;
 
class EdicionesController extends Controller {

    protected $edicionRepo;

    public function __construct(EdicionRepo $edicionRepo)
    {
        $this->edicionRepo = $edicionRepo;
    }

    public function index()
    {
        return View('ediciones.index');
    }

    public function all()
    {
        $ediciones = $this->edicionRepo->paginaterepo(15);
        return response()->json($ediciones);
    }

    public function paginatep(){
        $ediciones = $this->edicionRepo->paginaterepo(15);
        return response()->json($ediciones);
    }


    public function form_create()
    {
        return View('ediciones.form_create');
    }

    public function form_edit()
    {
        return View('ediciones.form_edit');
    }

    public function create(Request $request)
    {
        $ediciones = $this->edicionRepo->getModel();
        $manager = new EdicionManager($ediciones,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$ediciones->nombre]);
    }

    public function find($id)
    {
        $edicion = $this->edicionRepo->find($id);
        return response()->json($edicion);
    }

    public function edit(Request $request)
    {
        $edicion = $this->edicionRepo->find($request->id);

        $manager = new EdicionManager($edicion,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$edicion->nombre]);
    }

    public function destroy(Request $request)
    {
        $edicion= $this->edicionRepo->find($request->id);
        $edicion->delete();
        return response()->json(['estado'=>true, 'nombre'=>$edicion->nombre]);
    }

    public function search($q)
    {
        $ediciones = $this->edicionRepo->search($q);

        return response()->json($ediciones);
    }
}