<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\MotivoVentasRepo;
use Salesfly\Salesfly\Managers\MotivoVentasManager;
 
class MotivoVentasController extends Controller {

    protected $motivoVentasRepo;

    public function __construct(MotivoVentasRepo $motivoVentasRepo)
    {
        $this->motivoVentasRepo = $motivoVentasRepo;
    }

    public function index()
    {
        return View('motivoVentas.index');
    }

    public function all()
    {
        $motivoVentas = $this->motivoVentasRepo->paginate(15);
        return response()->json($motivoVentas);
    }

    public function paginatep(){
        $motivoVentas = $this->motivoVentasRepo->paginate(15);
        return response()->json($motivoVentas);
    }


    public function form_create()
    {
        return View('motivoVentas.form_create');
    }

    public function form_edit()
    {
        return View('motivoVentas.form_edit');
    }

    public function create(Request $request)
    {
        $motivoVentas = $this->motivoVentasRepo->getModel();
        $manager = new MotivoVentasManager($motivoVentas,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$motivoVentas->nombre]);
    }

    public function find($id)
    {
        $station = $this->motivoVentasRepo->find($id);
        return response()->json($station);
    }

    public function edit(Request $request)
    {
        $station = $this->motivoVentasRepo->find($request->id);

        $manager = new MotivoVentasManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->motivoVentasRepo->find($request->id);
        $station->delete();
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        $motivoVentas = $this->motivoVentasRepo->search($q);

        return response()->json($motivoVentas);
    }
}