<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;
use Salesfly\Salesfly\Repositories\InputStockRepo;
use Salesfly\Salesfly\Managers\InputStockManager;

use Salesfly\Salesfly\Repositories\HeadInputStockRepo;
use Salesfly\Salesfly\Managers\HeadInputStockManager;

use Salesfly\Salesfly\Repositories\DetailOrderPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailOrderPurchaseManager;
use Salesfly\Salesfly\Repositories\OrderPurchaseRepo;
use Salesfly\Salesfly\Managers\OrderPurchaseManager;

use Salesfly\Salesfly\Repositories\DetPresRepo;

use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;

class InputStocksController extends Controller
{
    protected $inputStockRepo;
    protected $orderPurchaseRepo;
    protected $detailOrderPurchaseRepo;
    protected $detPresRepo;
    protected $stockRepo;

    public function __construct(StockRepo $stockRepo,DetPresRepo $detPresRepo,OrderPurchaseRepo $orderPurchaseRepo,DetailOrderPurchaseRepo $detailOrderPurchaseRepo,InputStockRepo $inputStockRepo){
        $this->inputStockRepo = $inputStockRepo;
        $this->detPresRepo = $detPresRepo;
        $this->stockRepo = $stockRepo;
        $this->orderPurchaseRepo = $orderPurchaseRepo;
        $this->detailOrderPurchaseRepo = $detailOrderPurchaseRepo;
    }
    public function all(){
        return response()->json($this->equivRepo->all());
    }
    public function equivalencias($id){
    	$presentation = Presentation::find($id);
            $equiv = $presentation->equiv->load(['detAtr' => function ($query) {
                $query->orderBy('atribute_id', 'asc');
            },'product']);

    }
    public function paginate(){
        $inputStock=$this->inputStockRepo->select();
        return response()->json($inputStock);
    }
    
    public function create(Request $request){
       $var =$request->detailOrderPurchases;
        //var_dump($var);die();
       $almacen_id=$request->input("warehouses_id");
       $queHacer=$request->input("eliminar");
       if($queHacer===0){
       $orderPurchase = $this->orderPurchaseRepo->find($request->input('id'));
       $orderPurchase->detPres()->detach();
      
       foreach($var as $object){
      //  if($queHacer===0){
            //var_dump("hola");die();
        $detPres=$this->detPresRepo->listarVariantes($object['detPres_id']);
        $object["variant_id"]=$detPres->variant_id;
        $object["orderPurchase_id"]=$request->input("id");
        $object["warehouses_id"]=$request->input("warehouses_id");
        $object["descripcion"]="Ingreso por pedido";
        $detailOrderPurchaseRepox = new DetailOrderPurchaseRepo;
        $insertar=new DetailOrderPurchaseManager($detailOrderPurchaseRepox->getModel(),$object);
        $insertar->save();
        $detailOrderPurchaseRepox = null;
      // }

        $inputStock = $this->inputStockRepo->getModel();
         // var_dump($object);die();
        if(!empty($object["cantidad_llegado"])){
          
          if($object["cantidad_llegado"]>0){

            $inserInputStock = new inputStockManager($inputStock,$object);
            $inserInputStock->save();
          
        

        $stockmodel = new StockRepo;
                  $object['warehouse_id']=$almacen_id;
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
                  
            if(!empty($stockac)){ 
                if($object["esbase"]==0){
                  $object["stockActual"]=$stockac->stockActual+($object["cantidad_llegado"]*$object["equivalencia"]);
                }else{
                  $object["stockActual"]=$stockac->stockActual+$object["cantidad_llegado"];
                }
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
            }else{
                if($object["esbase"]==0)
                {
                    $object["stockActual"]=$object["cantidad_llegado"]*$object["equivalencia"];
                }else{
                    $object["stockActual"]=$object["cantidad_llegado"];
                }
                  $manager = new StockManager($stockmodel->getModel(),$object);
                  $manager->save();
                  $stockmodel = null;
            }
            $stockac=null;
        }}

       }}else{

       //==========================================================0
       $inputStock = $this->inputStockRepo->getModel();
          //var_dump($var);die();
        if(!empty($var["cantidad_llegado"])){
          
          if($var["cantidad_llegado"]>0){
            $var['warehouse_id']=$almacen_id;
            $var['warehouses_id']=$almacen_id;
            $inserInputStock = new inputStockManager($inputStock,$var);
            $inserInputStock->save();
          
        

        $stockmodel = new StockRepo;
                  //$var['warehouse_id']=$almacen_id;
                  $stockac=$stockmodel->encontrar($var["variant_id"],$almacen_id);
                  
            if(!empty($stockac)){ 
                if($var["esbase"]==0){
                  $var["stockActual"]=$stockac->stockActual+($var["cantidad_llegado"]*$var["equivalencia"]);
                }else{
                  $var["stockActual"]=$stockac->stockActual+$var["cantidad_llegado"];
                }
                  $manager = new StockManager($stockac,$var);
                  $manager->save();
                  $stock=null;
            }else{
                if($var["esbase"]==0)
                {
                    $var["stockActual"]=$var["cantidad_llegado"]*$var["equivalencia"];
                }else{
                    $var["stockActual"]=$var["cantidad_llegado"];
                }
                  $manager = new StockManager($stockmodel->getModel(),$var);
                  $manager->save();
                  $stockmodel = null;
            }
            $stockac=null;
        }}}
       ////======================================================00
       return response()->json(['estado'=>true]);

    }
}