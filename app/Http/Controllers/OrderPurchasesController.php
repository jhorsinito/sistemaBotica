<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\OrderPurchaseRepo;
use Salesfly\Salesfly\Managers\OrderPurchaseManager;

//use Intervention\Image\Facades\Image;

class OrderPurchasesController extends Controller {

    protected $orderPurchaseRepo;

    public function __construct(OrderPurchaseRepo $orderPurchaseRepo)
    {
        $this->orderPurchaseRepo = $orderPurchaseRepo;
    }

    public function index()
    {
        return View('orderPurchases.index');
    }
  
    public function all($estado)
    {
        $orderPurchases = $this->orderPurchaseRepo->searchEstados($estado);
        return response()->json($orderPurchases);
        //var_dump($orderPurchases);
    }

    public function paginatep(){
        $orderPurchases = $this->orderPurchaseRepo->paginar();
        return response()->json($orderPurchases);
    }


    public function form_create()
    {
        return View('orderPurchases.form_create');
    }
    public function form_createP()
    {
        return View('orderPurchases.form_createP');
    }

    public function form_edit()
    {
        return View('orderPurchases.form_edit');
    }

    public function create(Request $request)
    {
        $orderPurchase = $this->orderPurchaseRepo->getModel();       
        $manager = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista'));
        $manager->save();
       if($this->orderPurchaseRepo->validateDate(substr($request->input('fechaPedido'),0,10)) and $this->orderPurchaseRepo->validateDate(substr($request->input('fechaPrevista'),0,10)) ){
            $orderPurchase->fechaPedido = substr($request->input('fechaPedido'),0,10);
             $orderPurchase->fechaPrevista = substr($request->input('fechaPrevista'),0,10);
        }else{
           
            $orderPurchase->fechaPedido = null;
             $orderPurchase->fechaPrevista = null;
        }

        $orderPurchase->save();


        return response()->json(['estado'=>true, 'nombres'=>$orderPurchase->nombres,'codigo'=>$orderPurchase->id,'warehouse_id'=>$orderPurchase->warehouses_id]);
    }

    public function find($id)
    {
        $orderPurchase = $this->orderPurchaseRepo->find($id);
        return response()->json($orderPurchase);
    }
    public function mostrarEmpresa($id){
    $orderPurchase=$this->orderPurchaseRepo->traerSumplier($id);
    return response()->json($orderPurchase);
    }

    public function edit(Request $request)
    {
       $orderPurchase = $this->orderPurchaseRepo->find($request->id);
       if($request->Estado == 0){
        $manager = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista'));
        $manager->save();
    }else{
       $manager = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista','montoBruto','montoTotal','descuento'));
        $manager->save(); 
    }
       if($this->orderPurchaseRepo->validateDate(substr($request->input('fechaPedido'),0,10)) and $this->orderPurchaseRepo->validateDate(substr($request->input('fechaPrevista'),0,10))){
            $orderPurchase->fechaPedido = substr($request->input('fechaPedido'),0,10);
             $orderPurchase->fechaPrevista = substr($request->input('fechaPrevista'),0,10);
        }else{
           
            $orderPurchase->fechaPedido = null;
             $orderPurchase->fechaPrevista = null;
        }

        $orderPurchase->save();

        return response()->json(['estado'=>true, 'nombres'=>$orderPurchase->nombres]);
       
       
    }
    public function createDetalle()
    {
        return View('orderPurchases.form_createDetalle');
    }

    public function destroy(Request $request)
    {
        $orderPurchase= $this->orderPurchaseRepo->find($request->id);
        $orderPurchase->delete();
        return response()->json(['estado'=>true, 'nombre'=>$orderPurchase->nombre]);
    }

    public function search($q)
    {
        
        $orderPurchases = $this->orderPurchaseRepo->search($q);

        return response()->json($orderPurchases);
    }

}