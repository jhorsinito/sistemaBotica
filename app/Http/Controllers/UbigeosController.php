<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\UbigeoRepo;
use Salesfly\Salesfly\Managers\UbigeoManager;
 
class UbigeosController extends Controller {

    protected $ubigeoRepo;

    public function __construct(UbigeoRepo $ubigeoRepo)
    {
        $this->ubigeoRepo = $ubigeoRepo;
    }

    public function index()
    {
        return View('ubigeos.index');
    }

    public function all()
    {
        $ubigeos = $this->ubigeoRepo->paginate(15);
        return response()->json($ubigeos);
    }

    public function paginatep(){
        $ubigeos = $this->ubigeoRepo->paginate(15);
        return response()->json($ubigeos);
    }


    public function form_create()
    {
        return View('ubigeos.form_create');
    }

    public function form_edit()
    {
        return View('ubigeos.form_edit');
    }

    public function create(Request $request)
    {
        $ubigeos = $this->ubigeoRepo->getModel();
        $manager = new UbigeoManager($ubigeos,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$ubigeos->nombre]);
    }

    public function find($id)
    {
        $station = $this->ubigeoRepo->find($id);
        return response()->json($station);
    }

    public function edit(Request $request)
    {
        $station = $this->ubigeoRepo->find($request->id);

        $manager = new UbigeoManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->ubigeoRepo->find($request->id);
        $station->delete();
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        $ubigeos = $this->ubigeoRepo->search($q);

        return response()->json($ubigeos);
    }
    public function validarCodigo($text){
        $ubigeos = $this->ubigeoRepo->validarNoRepitCodigo($text);
        return response()->json($ubigeos);
    }

    //-------------------------
    public function ubigeoDepartament()
    {
        $ubigeos = $this->ubigeoRepo->ubigeoDepartament();
        return response()->json($ubigeos);
    }
}