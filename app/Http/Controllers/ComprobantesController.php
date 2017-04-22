<?php
namespace Salesfly\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Salesfly\Salesfly\Repositories\ComprobanteRepo;
use Salesfly\Salesfly\Managers\ComprobanteManager;
 
class ComprobantesController extends Controller {
    protected $comprobanteRepo;
    public function __construct(ComprobanteRepo $comprobanteRepo)
    {
        $this->comprobanteRepo = $comprobanteRepo;
    }
    public function index()
    {
        return View('comprobantes.index');
    }
    public function all()
    {
        $comprobantes = $this->comprobanteRepo->paginate(15);
        return response()->json($comprobantes);
    }

    public function allComprobantes()
    {
        
        $comprobantes = $this->comprobanteRepo->allComprobantes();
        return response()->json($comprobantes);
    }
   
    public function paginatep(){
        $comprobantes = $this->comprobanteRepo->paginate(15);
        return response()->json($comprobantes);
    }
    public function form_create()
    {
        return View('comprobantes.form_create');
    }
    public function form_edit()
    {
        return View('comprobantes.form_edit');
    }
    public function create(Request $request)
    {
        $comprobantes = $this->comprobanteRepo->getModel();
        $manager = new ComprobanteManager($comprobantes,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$comprobantes->nombre]);
    }
    public function find($id)
    {
        $comprobante = $this->comprobanteRepo->find($id);
        return response()->json($comprobante);
    }
    public function edit(Request $request)
    {
        $comprobante = $this->comprobanteRepo->find($request->id);
        $manager = new ComprobanteManager($comprobante,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$comprobante->nombre]);
    }
    public function destroy(Request $request)
    {
        $comprobante= $this->comprobanteRepo->find($request->id);
        $comprobante->delete();
        return response()->json(['estado'=>true, 'nombre'=>$comprobante->nombre]);
    }
    public function search($q)
    {
        $comprobantes = $this->comprobanteRepo->search($q);
        return response()->json($comprobantes);
    }
}