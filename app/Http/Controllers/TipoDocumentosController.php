<?php
namespace Salesfly\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Salesfly\Salesfly\Repositories\TipoDocumentoRepo;
use Salesfly\Salesfly\Managers\TipoDocumentoManager;
 
class TipoDocumentosController extends Controller {
    protected $tipoDocumentoRepo;
    public function __construct(TipoDocumentoRepo $tipoDocumentoRepo)
    {
        $this->tipoDocumentoRepo = $tipoDocumentoRepo;
    }
    public function index()
    {
        return View('tipoDocumentos.index');
    }
    public function all()
    {
        $tipoDocumentos = $this->tipoDocumentoRepo->paginate(15);
        return response()->json($tipoDocumentos);
    }

    public function allTipoDocumentos()
    {
        
        $tipoDocumentos = $this->tipoDocumentoRepo->allTipoDocumentos();
        return response()->json($tipoDocumentos);
    }
   
    public function paginatep(){
        $tipoDocumentos = $this->tipoDocumentoRepo->paginate(15);
        return response()->json($tipoDocumentos);
    }
    public function form_create()
    {
        return View('tipoDocumentos.form_create');
    }
    public function form_edit()
    {
        return View('tipoDocumentos.form_edit');
    }
    public function create(Request $request)
    {
        $tipoDocumentos = $this->tipoDocumentoRepo->getModel();
        $manager = new TipoDocumentoManager($tipoDocumentos,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$tipoDocumentos->nombre]);
    }
    public function find($id)
    {
        $tipoDocumento = $this->tipoDocumentoRepo->find($id);
        return response()->json($tipoDocumento);
    }
    public function edit(Request $request)
    {
        $tipoDocumento = $this->tipoDocumentoRepo->find($request->id);
        $manager = new TipoDocumentoManager($tipoDocumento,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$tipoDocumento->nombre]);
    }
    public function destroy(Request $request)
    {
        $tipoDocumento= $this->tipoDocumentoRepo->find($request->id);
        $tipoDocumento->delete();
        return response()->json(['estado'=>true, 'nombre'=>$tipoDocumento->nombre]);
    }
    public function search($q)
    {
        $tipoDocumentos = $this->tipoDocumentoRepo->search($q);
        return response()->json($tipoDocumentos);
    }
}