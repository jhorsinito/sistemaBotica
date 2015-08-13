<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PurchaseRepo;
use Salesfly\Salesfly\Managers\PurchaseManager;
use Salesfly\Salesfly\Repositories\DetailPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailPurchaseManager;

//use Intervention\Image\Facades\Image;

class PurchasesController extends Controller {

    protected $purchaseRepo;

   /** public function __construct(PurchaseRepo $purchaseRepo)
    {
        $this->purchaseRepo = $purchaseRepo;
    }*/

    public function __construct(DetailPurchaseRepo $detailPurchaseRepo, PurchaseRepo $purchaseRepo)
    {
        $this->detailPurchaseRepo = $detailPurchaseRepo;
        $this->purchaseRepo = $purchaseRepo;
    }

    public function index()
    {
        return View('purchases.index');
    }
    /*public function mostarUltimoagregado(){
        $purchases=$this->purchaseRepo->ultimoDato();
         return response()->json($purchases);
    }*/
    public function all()
    {
        $purchases = $this->purchaseRepo->paginate(15);
        return response()->json($purchases);
        //var_dump($purchases);
    }

    public function paginatep(){
        $purchases = $this->purchaseRepo->paginar(15);
        return response()->json($purchases);
    }


    public function form_create()
    {
        return View('purchases.form_create');
    }

    public function form_edit()
    {
        return View('purchases.form_edit');
    }

    public function create(Request $request)
        {
        $purchase = $this->purchaseRepo->getModel();
        //$detailPurchase = $this->detailPurchaseRepo->getModel();

        $var = $request->detailOrderPurchases;//->merge(array('purchases_id' => '10'));
       //var_dump($var); die();
        $manager = new PurchaseManager($purchase,$request->except('fechaEntrega'));
        $manager->save();
       if($this->purchaseRepo->validateDate(substr($request->input('fechaEntrega'),0,10))){
            $purchase->fechaEntrega = substr($request->input('fechaEntrega'),0,10);
        }else{
           
            $purchase->fechaEntrega = null;
        }

        $purchase->save();
        $temporal=$purchase->id;
  $detailPurchaseRepox;
         
       foreach($var as $object){
          //var_dump($object); die();
           $object['purchases_id'] = $temporal;
           $detailPurchaseRepox = new DetailPurchaseRepo;
           $insertar=new DetailPurchaseManager($detailPurchaseRepox->getModel(),$object);
           $insertar->save();
          
           $detailPurchaseRepox = null;

       }
     return response()->json(['estado'=>true, 'nombres'=>$purchase->nombres]);
    }

    public function find($id)
    {
        $purchase = $this->purchaseRepo->select($id);
        return response()->json($purchase);
    }
    public function mostrarEmpresa($id){
    $purchase=$this->purchaseRepo->traerSumplier($id);
    return response()->json($purchase);
    }

    public function edit(Request $request)
    {
       $purchase = $this->purchaseRepo->find($request->id);

        $manager = new PurchaseManager($purchase,$request->except('fechaEntrega'));
        $manager->save();
       if($this->purchaseRepo->validateDate(substr($request->input('fechaEntrega'),0,10))){
            $purchase->fechaEntrega = substr($request->input('fechaEntrega'),0,10);
        }else{
           
            $purchase->fechaEntrega = null;
        }

        $purchase->save();

        return response()->json(['estado'=>true, 'nombres'=>$purchase->nombres]);
       
       
    }

    public function destroy(Request $request)
    {
        $purchase= $this->purchaseRepo->find($request->id);
        $purchase->delete();
        //Event::fire('update.purchase',$purchase->all());
        return response()->json(['estado'=>true, 'nombre'=>$purchase->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $purchases = $this->purchaseRepo->search($q);

        return response()->json($purchases);
    }

    /*public function get_string_between($string, $start, $end){
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }*/
}