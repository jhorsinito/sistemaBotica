<?php
namespace Salesfly\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Salesfly\Salesfly\Repositories\ProveedorRepo;
use Salesfly\Salesfly\Managers\ProveedorManager;
 
class ProveedoresController extends Controller {
    protected $proveedorRepo;
    public function __construct(ProveedorRepo $proveedorRepo)
    {
        $this->proveedorRepo = $proveedorRepo;
    }
    public function index()
    {
        return View('proveedores.index');
    }
    public function all()
    {
        $proveedores = $this->proveedorRepo->paginate(15);
        return response()->json($proveedores);
    }

    public function allProveedores()
    { 
        $proveedores = $this->proveedorRepo->allProveedores();
        return response()->json($proveedores);
    }
   
    public function paginatep(){
        $proveedores = $this->proveedorRepo->paginate(15);
        return response()->json($proveedores);
    }
    public function form_create()
    {
        return View('proveedores.form_create');
    }
    public function form_edit()
    {
        return View('proveedores.form_edit');
    }
    public function create(Request $request)
    {
        $proveedores = $this->proveedorRepo->getModel();
        $manager = new ProveedorManager($proveedores,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$proveedores->nombre]);
    }
    public function find($id)
    {
        $proveedor = $this->proveedorRepo->find($id);
        return response()->json($proveedor);
    }
    public function edit(Request $request)
    {
        $proveedor = $this->proveedorRepo->find($request->id);
        $manager = new ProveedorManager($proveedor,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$proveedor->nombre]);
    }
    public function destroy(Request $request)
    {
        $proveedor= $this->proveedorRepo->find($request->id);
        $proveedor->delete();
        return response()->json(['estado'=>true, 'nombre'=>$proveedor->nombre]);
    }
    public function search($q)
    {
        $proveedores = $this->proveedorRepo->search($q);
        return response()->json($proveedores);
    }
}