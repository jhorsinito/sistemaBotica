<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetailOrderPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailOrderPurchaseManager;
use Salesfly\Salesfly\Repositories\OrderPurchaseRepo;
use Salesfly\Salesfly\Managers\OrderPurchaseManager;
class DetailOrderPurchasesController extends Controller {

    protected $detailOrderPurchaseRepo;
    protected $orderPurchaseRepo;

    public function __construct(DetailOrderPurchaseRepo $detailOrderPurchaseRepo, OrderPurchaseRepo $orderPurchaseRepo)
    {
        $this->detailOrderPurchaseRepo = $detailOrderPurchaseRepo;
        $this->orderPurchaseRepo = $orderPurchaseRepo;
    }


    public function index()
    {
        return View('detailPurchase.index');
        //return 'hola';
    }

    public function all($estado)
    {
        $detailOrderPurchases = $this->detailOrderPurchaseRepo->paginaporEstados($estado);
        return response()->json($detailOrderPurchases);
        //var_dump($materials);
    }

    public function paginatep($id){
        $detailOrderPurchases =$this->detailOrderPurchaseRepo->paginate($id);
        return response()->json($detailOrderPurchases);
    }


    public function form_create()
    {
        return View('detailOrderPurchases.form_create');
    }

    public function form_edit()
    {
        return View('detailOrderPurchases.form_edit');
    }

    public function create(Request $request)
    {
  //-----------------------------------------------------
  $var =$request->all();
  $detailOrderPurchaseRepox;
         
       foreach($var as $object){

           $detailOrderPurchaseRepox = new DetailOrderPurchaseRepo;
           $insertar=new DetailOrderPurchaseManager($detailOrderPurchaseRepox->getModel(),$object);
           $insertar->save();
           $detailOrderPurchaseRepox = null;

       }
      return response()->json(['estado'=>true]);
    }
    public function destroy(Request $request)
    {
      
           $detailOrderPurchases= $this->detailOrderPurchaseRepo->find($request->id);
        $detailOrderPurchases->delete();
       
      return response()->json(['estado'=>true]);
        
    }
    public function Eliminar($id){
         $detailOrderPurchases = $this->detailOrderPurchaseRepo->Eliminar($id);
        return response()->json($detailOrderPurchases);
    }

    public function find($id)
    {
        $detailOrderPurchases = $this->detailOrderPurchaseRepo->find($id);
        return response()->json($detailOrderPurchases);
    }

    public function edit(Request $request)
    {
       $var=$request->detailOrderPurchases;//->except($request->detailOrderPurchases["id"]);
       $orderPurchase = $this->orderPurchaseRepo->find($request->input('id'));

       $orderPurchase->detPres()->detach();
       foreach($var as $object){
        $detailOrderPurchaseRepox = new DetailOrderPurchaseRepo;
        $insertar=new DetailOrderPurchaseManager($detailOrderPurchaseRepox->getModel(),$object);
        $insertar->save();
        $detailOrderPurchaseRepox = null;

       }
      return response()->json(['estado'=>true]);
    }

    

    public function search($q)
    {
        //$q = Input::get('q');
        $detailOrderPurchases = $this->detailOrderPurchaseRepo->search($q);

        return response()->json($detailOrderPurchases);
    }
}