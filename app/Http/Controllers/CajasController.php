<?php
namespace Salesfly\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Mockery\Matcher\Type;

use Illuminate\Routing\Controller;
use Salesfly\Salesfly\Entities\Caja;
use Salesfly\Salesfly\Repositories\CajaRepo;
use Salesfly\Salesfly\Managers\CajaManager;
use Salesfly\Salesfly\Entities\Tienda;
use Salesfly\Salesfly\Entities\Almacen;
 
class CajasController extends Controller {
    protected $cajaRepo;
    public function __construct(CajaRepo $cajaRepo)
    {
        $this->cajaRepo = $cajaRepo;
          $this->middleware('auth');
    }
    public function index()
    {
        return View('cajas.index');
    }
    public function all()
    {
        $cajas = $this->cajaRepo->paginate(15);
        return response()->json($cajas);
    }

   
    public function paginatep(){
        $cajas = $this->cajaRepo->paginate(15);
        return response()->json($cajas);
    }

    public function form_create()
    {
        return View('cajas.form_create');
    }
    public function form_edit()
    {
        return View('cajas.form_edit');
    }
    public function create(Request $request)
    {
         \DB::beginTransaction();
        $caja = $this->cajaRepo->getModel();
        $request->merge(array('user_id' => Auth()->user()->name));
        $managerPro = new CajaManager($caja,$request->except(''));
        if($request->input('estado2') === true){
            $managerPro->save();
            $request->merge(array('caja_id' => $caja->id));
            $caja->save();
            $temporal=$caja->id;
        }

        \DB::commit();
        return response()->json(['estado'=>true, 'nombres'=>$caja->nombre]);

    }

    public function find($id)
    {
        $caja = $this->cajaRepo->find($id);
        return response()->json($caja);
    }
    public function edit(Request $request)
    {
        $caja = $this->cajaRepo->find($request->id);
        $manager = new CajaManager($caja,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$caja->nombre]);
    }
    public function destroy(Request $request)
    {
        $caja= $this->cajaRepo->find($request->id);
        $caja->delete();
        return response()->json(['estado'=>true, 'nombre'=>$caja->nombre]);
    }
    public function search($q)
    {
        $cajas = $this->cajaRepo->search($q);
        return response()->json($cajas);
    }

      public function tiendas_select(){
        $tiendas = Tienda::lists('nombreTienda','nombreTienda');
        return response()->json($tiendas);
    }

     public function almacenes_select(){
        $almacenes = Almacen::lists('nombreAlmacen','nombreAlmacen');
        return response()->json($almacenes);
    }
}