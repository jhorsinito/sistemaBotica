<?php
namespace Salesfly\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Salesfly\Salesfly\Repositories\MetodoPagoRepo;
use Salesfly\Salesfly\Managers\MetodoPagoManager;
 
class MetodoPagosController extends Controller {
    protected $metodoPagoRepo;
    public function __construct(MetodoPagoRepo $metodoPagoRepo)
    {
        $this->metodoPagoRepo = $metodoPagoRepo;
    }
    public function index()
    {
        return View('metodoPagos.index');
    }
    public function all()
    {
        $metodoPagos = $this->metodoPagoRepo->paginate(15);
        return response()->json($metodoPagos);
    }

    public function allMetodoPagos()
    {
        
        $metodoPagos = $this->metodoPagoRepo->allMetodoPagos();
        return response()->json($metodoPagos);
    }
   
    public function paginatep(){
        $metodoPagos = $this->metodoPagoRepo->paginate(15);
        return response()->json($metodoPagos);
    }
    public function form_create()
    {
        return View('metodoPagos.form_create');
    }
    public function form_edit()
    {
        return View('metodoPagos.form_edit');
    }
    public function create(Request $request)
    {
        $metodoPagos = $this->metodoPagoRepo->getModel();
        $manager = new MetodoPagoManager($metodoPagos,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$metodoPagos->nombre]);
    }
    public function find($id)
    {
        $metodoPago = $this->metodoPagoRepo->find($id);
        return response()->json($metodoPago);
    }
    public function edit(Request $request)
    {
        $metodoPago = $this->metodoPagoRepo->find($request->id);
        $manager = new MetodoPagoManager($metodoPago,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$metodoPago->nombre]);
    }
    public function destroy(Request $request)
    {
        $metodoPago= $this->metodoPagoRepo->find($request->id);
        $metodoPago->delete();
        return response()->json(['estado'=>true, 'nombre'=>$metodoPago->nombre]);
    }
    public function search($q)
    {
        $metodoPagos = $this->metodoPagoRepo->search($q);
        return response()->json($metodoPagos);
    }
}