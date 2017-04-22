<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Mockery\Matcher\Type;
use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;
use Salesfly\Salesfly\Entities\Venta;
use Salesfly\Salesfly\Repositories\VentaRepo;
use Salesfly\Salesfly\Managers\VentaManager;

use Salesfly\Salesfly\Entities\Tienda;
use Salesfly\Salesfly\Entities\Comprobante;
use Salesfly\Salesfly\Entities\Cliente;
use Salesfly\Salesfly\Entities\Product;



class VentasController extends Controller
{
    protected $ventaRepo;

    public function __construct(VentaRepo $ventaRepo)
    {
        $this->ventaRepo = $ventaRepo;
        $this->middleware('auth');
      
    }
 
    public function index()
    {
        
        return View('ventas.index');
    }

    public function all()
    {
        $ventas = $this->ventaRepo->paginate(15);
        return response()->json($ventas);
    }

    public function paginate(){
        $ventas = $this->ventaRepo->paginate(15);
        return response()->json($ventas);
    }
   
 
    public function form_create()
    {
        return View('ventas.form_create');
    }
   
    public function form_edit()
    {
        return View('ventas.form_edit');
    }

    public function create(Request $request)
    {
        
    \DB::beginTransaction();
        $venta = $this->ventaRepo->getModel();
        $request->merge(array('user_id' => Auth()->user()->id));
        $managerPro = new VentaManager($venta,$request->except(''));
        if($request->input('estado2') === true){
            $managerPro->save();
            $request->merge(array('venta_id' => $venta->id));
            $venta->save();
            $temporal=$venta->id;
        }

        \DB::commit();
        return response()->json(['estado'=>true, 'nombres'=>$venta->nombre]);
    }

  
    public function find($id)
    {
        $venta = $this->ventaRepo->find($id);
        return response()->json($venta);
    }

    public function edit(Request $request)
    {
         $venta = $this->ventaRepo->find($request->id);
        $manager = new VentaManager($venta,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$venta->nombre]);
    }

      public function destroy(Request $request)
    {
        
       $venta= $this->ventaRepo->find($request->proId);
        $venta->delete();
        return response()->json(['estado'=>true, 'nombre'=>$venta->nombre]);
    }
    public function disableprod($proId){
        
        \DB::beginTransaction();
        $venta = Venta::find($proId);
        $estado = $venta->estado;
        
        if("") {
       
            if ($estado == 1) {
                $venta->estado = 0;
            } else {
              $venta->estado = 1; 
            }
           
        }else{
            if ($estado == 1) {
                $venta->estado = 0;
            } else {
                $venta->estado = 1;        
            }
        }
        $venta->save();

        \DB::commit();
        return response()->json(['estado'=>true]);
    }

    public function tiendas_select(){
        $tiendas = Tienda::lists('nombreTienda','id');
        return response()->json($tiendas);
    }
    public function clientes_select(){
        $clientes = Cliente::lists('nombreCliente','id');
        return response()->json($clientes);
    }
    public function comprobantes_select(){
        $comprobantes = Comprobante::lists('nombreComprobante','id');
        return response()->json($comprobantes);
    }
    public function products_select(){
        $products = Product::lists('nombre','id');
        return response()->json($products);
    }
    public function search($q)
    {
      
        $customers = $this->ventaRepo->search($q);

        return response()->json($customers);
    }

    
  
}