<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetComercialGenericoRepo;
use Salesfly\Salesfly\Managers\DetComercialGenericoManager;

class DetComercialGenericoController extends Controller {

    protected $detComercialGenericoRepo;

    public function __construct(DetComercialGenericoRepo $detComercialGenericoRepo)
    {
        $this->detComercialGenericoRepo = $detComercialGenericoRepo;
    }

    public function index()
    {
        return View('detComercialGenericos.index');
    }

    public function all()
    {
        $detComercialGenericos = $this->detComercialGenericoRepo->all();
        return response()->json($detComercialGenericos);
    }

    public function paginatep(){
        $detComercialGenericos = $this->detComercialGenericoRepo->paginate(15);
        return response()->json($detComercialGenericos);
    }


    public function form_create()
    {
        return View('detComercialGenericos.form_create');
    }

    public function form_edit()
    {
        return View('detComercialGenericos.form_edit');
    }

    public function create(Request $request)
    {

        $detComercialGenerico = $this->detComercialGenericoRepo->getModel();    
        $manager = new DetComercialGenericoManager($detComercialGenerico,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$detComercialGenerico->nombre]);
    }

    public function find($id)
    {
        $detComercialGenerico = $this->detComercialGenericoRepo->find($id);
        return response()->json($detComercialGenerico);
    }
    public function buscarGenerioco($id)
    {
        $detComercialGenerico = $this->detComercialGenericoRepo->buscarGenerioco($id);
        return response()->json($detComercialGenerico);
    }
    public function buscarComercial($id)
    {
        $detComercialGenerico = $this->detComercialGenericoRepo->buscarComercial($id);
        return response()->json($detComercialGenerico);
    }

    public function edit(Request $request)
    {
        $detComercialGenerico = $this->detComercialGenericoRepo->find($request->id);
        $manager = new DetComercialGenericoManager($detComercialGenerico,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$detComercialGenerico->nombre]);
    }

    public function destroy(Request $request)
    {
        $detComercialGenerico= $this->detComercialGenericoRepo->find($request->id);
        $detComercialGenerico->delete();
        return response()->json(['estado'=>true, 'nombre'=>$detComercialGenerico->nombre]);
    }
}