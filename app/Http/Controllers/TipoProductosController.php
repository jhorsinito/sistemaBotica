<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\TipoProductoRepo;
use Salesfly\Salesfly\Managers\TipoProductoManager;

class TipoProductosController extends Controller {

    protected $tipoProductoRepo;

    public function __construct(TipoProductoRepo $tipoProductoRepo)
    {
        $this->tipoProductoRepo = $tipoProductoRepo;
    }

    public function index()
    {
        return View('tipoProductos.index');
    }

    public function all()
    {
        $tipoProductos = $this->tipoProductoRepo->paginate(15);
        return response()->json($tipoProductos);
    }

    public function paginatep(){
        $tipoProductos = $this->tipoProductoRepo->paginate(15);
        return response()->json($tipoProductos);
    }


    public function form_create()
    {
        return View('tipoProductos.form_create');
    }

    public function form_edit()
    {
        return View('tipoProductos.form_edit');
    }

    public function create(Request $request)
    {

        $tipoProducto = $this->tipoProductoRepo->getModel();    
        $manager = new TipoProductoManager($tipoProducto,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$tipoProducto->nombre]);
    }

    public function find($id)
    {
        $tipoProducto = $this->tipoProductoRepo->find($id);
        return response()->json($tipoProducto);
    }

    public function edit(Request $request)
    {
        $tipoProducto = $this->tipoProductoRepo->find($request->id);
        $manager = new TipoProductoManager($tipoProducto,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$tipoProducto->nombre]);
    }

    public function destroy(Request $request)
    {
        $tipoProducto= $this->tipoProductoRepo->find($request->id);
        $tipoProducto->delete();
        return response()->json(['estado'=>true, 'nombre'=>$tipoProducto->nombre]);
    }

    public function search($q)
    {
        $tipoProductos = $this->tipoProductoRepo->search($q);

        return response()->json($tipoProductos);
    }
}