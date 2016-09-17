<?php
namespace Salesfly\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Salesfly\Salesfly\Repositories\TiendaRepo;
use Salesfly\Salesfly\Managers\TiendaManager;
 
class TiendasController extends Controller {
    protected $tiendaRepo;
    public function __construct(TiendaRepo $tiendaRepo)
    {
        $this->tiendaRepo = $tiendaRepo;
    }
    public function index()
    {
        return View('tiendas.index');
    }
    public function all()
    {
        $tiendas = $this->tiendaRepo->paginate(15);
        return response()->json($tiendas);
    }
   
    public function paginatep(){
        $tiendas = $this->tiendaRepo->paginate(15);
        return response()->json($tiendas);
    }
    public function form_create()
    {
        return View('tiendas.form_create');
    }
    public function form_edit()
    {
        return View('tiendas.form_edit');
    }
    public function create(Request $request)
    {
        $tiendas = $this->tiendaRepo->getModel();
        $manager = new TiendaManager($tiendas,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$tiendas->nombre]);
    }
    public function find($id)
    {
        $tienda = $this->tiendaRepo->find($id);
        return response()->json($tienda);
    }
    public function edit(Request $request)
    {
        $tienda = $this->tiendaRepo->find($request->id);
        $manager = new TiendaManager($tienda,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$tienda->nombre]);
    }
    public function destroy(Request $request)
    {
        $tienda= $this->tiendaRepo->find($request->id);
        $tienda->delete();
        return response()->json(['estado'=>true, 'nombre'=>$tienda->nombre]);
    }
    public function search($q)
    {
        $tiendas = $this->tiendaRepo->search($q);
        return response()->json($tiendas);
    }
}