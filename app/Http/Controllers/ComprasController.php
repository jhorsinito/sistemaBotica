<?php
namespace Salesfly\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Salesfly\Salesfly\Repositories\CompraRepo;
use Salesfly\Salesfly\Managers\CompraManager;
//use Salesfly\Salesfly\Repositories\ProveedorRepo;
 
class ComprasController extends Controller {
    protected $compraRepo;
    public function __construct(CompraRepo $compraRepo)
    {
        $this->compraRepo = $compraRepo;
        /*nuevo*/ $this->middleware('auth');

    }
    public function index()
    {
        return View('compras.index');
    }
    public function all()
    {
        $compras = $this->compraRepo->paginate(15);
        return response()->json($compras);
    }

    public function allCompras()
    {
        $compras = $this->compraRepo->allCompras();
        return response()->json($compras);
    }
   
    public function paginatep(){
        $compras = $this->compraRepo->paginate(15);
        return response()->json($compras);
    }
    public function form_create()
    {
        return View('compras.form_create');
    }
    public function form_edit()
    {
        return View('compras.form_edit');
    }
    public function create(Request $request)
    {
        $compras = $this->compraRepo->getModel();
        $manager = new CompraManager($compras,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$compras->nombre]);
     
    }
    public function find($id)
    {
        $compra = $this->compraRepo->find($id);
        return response()->json($compra);
    }
    public function edit(Request $request)
    {
        $compra = $this->compraRepo->find($request->id);
        $manager = new CompraManager($compra,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$compra->nombre]);
    }
    public function destroy(Request $request)
    {
        $compra= $this->compraRepo->find($request->id);
        $compra->delete();
        return response()->json(['estado'=>true, 'nombre'=>$compra->nombre]);
    }
    public function search($q)
    {
        $compras = $this->compraRepo->search($q);
        return response()->json($compras);
    }
}