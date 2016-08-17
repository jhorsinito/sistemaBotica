<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\BancoRepo;
use Salesfly\Salesfly\Managers\BancoManager;
 
class BancosController extends Controller {

    protected $bancoRepo;

    public function __construct(BancoRepo $bancoRepo)
    {
        $this->bancoRepo = $bancoRepo;
    }

    public function index()
    {
        return View('bancos.index');
    }

    public function all()
    {
        $bancos = $this->bancoRepo->paginate(15);
        return response()->json($bancos);
    }

    public function paginatep(){
        $bancos = $this->bancoRepo->paginate(15);
        return response()->json($bancos);
    }


    public function form_create()
    {
        return View('bancos.form_create');
    }

    public function form_edit()
    {
        return View('bancos.form_edit');
    }

    public function create(Request $request)
    {
        $bancos = $this->bancoRepo->getModel();
        $manager = new BancoManager($bancos,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$bancos->nombre]);
    }

    public function find($id)
    {
        $station = $this->bancoRepo->find($id);
        return response()->json($station);
    }

    public function edit(Request $request)
    {
        $station = $this->bancoRepo->find($request->id);

        $manager = new BancoManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->bancoRepo->find($request->id);
        $station->delete();
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        $bancos = $this->bancoRepo->search($q);

        return response()->json($bancos);
    }
}