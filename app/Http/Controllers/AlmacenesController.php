<?php
namespace Salesfly\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Salesfly\Salesfly\Repositories\AlmacenRepo;
use Salesfly\Salesfly\Managers\AlmacenManager;
 
class AlmacenesController extends Controller {
    protected $almacenRepo;
    public function __construct(AlmacenRepo $almacenRepo)
    {
        $this->almacenRepo = $almacenRepo;
    }
    public function index()
    {
        return View('almacenes.index');
    }
    public function all()
    {
        $almacenes = $this->almacenRepo->paginaterepo(15);
        return response()->json($almacenes);
    }
   
    public function paginatep(){
        $almacenes = $this->almacenRepo->paginaterepo(15);
        return response()->json($almacenes);
    }
    public function form_create()
    {
        return View('almacenes.form_create');
    }
    public function form_edit()
    {
        return View('almacenes.form_edit');
    }
    public function create(Request $request)
    {
        $almacenes = $this->almacenRepo->getModel();
        $manager = new AlmacenManager($almacenes,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$almacenes->nombre]);
    }
    public function find($id)
    {
        $almacen = $this->almacenRepo->find($id);
        return response()->json($almacen);
    }
    public function edit(Request $request)
    {
        $almacen = $this->almacenRepo->find($request->id);
        $manager = new AlmacenManager($almacen,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$almacen->nombre]);
    }
    public function destroy(Request $request)
    {
        $almacen= $this->almacenRepo->find($request->id);
        $almacen->delete();
        return response()->json(['estado'=>true, 'nombre'=>$almacen->nombre]);
    }
    public function search($q)
    {
        $almacenes = $this->almacenRepo->search($q);
        return response()->json($almacenes);
    }
}