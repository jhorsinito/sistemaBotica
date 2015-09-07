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

    public function __construct(HeadInputStockRepo $headInputStockRepo,StockRepo $stockRepo,DetPresRepo $detPresRepo,OrderPurchaseRepo $orderPurchaseRepo,DetailOrderPurchaseRepo $detailOrderPurchaseRepo,InputStockRepo $inputStockRepo){
        $this->inputStockRepo = $inputStockRepo;
        $this->detPresRepo = $detPresRepo;
        $this->stockRepo = $stockRepo;
        $this->orderPurchaseRepo = $orderPurchaseRepo;
        $this->detailOrderPurchaseRepo = $detailOrderPurchaseRepo;
        $this->headInputStockRepo=$headInputStockRepo;
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
        $inputStock=$this->headInputStockRepo->select();
        return response()->json($inputStock);
    }
    public function paginate2($id){
        $inputStock=$this->inputStockRepo->selected($id);
        return response()->json($inputStock);
    }
    
    public function create(Request $request){
       $var =$request->detailOrderPurchases;
    //var_dump($request->input('id'));die();
       $codigoHeadIS;
       $almacen_id=$request->input("warehouses_id");
       $queHacer=$request->input("eliminar");
       $tipo=$request->input("tipo");
       $tipo2="Salida";
       $request->merge(['user_id'=>auth()->user()->id]);
       //var_dump();die();
       if($queHacer===0){
        $request->merge(["orderPurchase_id"=>$request->input('id')]);
        $headInputStock = $this->headInputStockRepo->getModel();
        $inserHeadInputStock = new HeadInputStockManager($headInputStock,$request->all());
            $inserHeadInputStock->save();
            $codigoHeadIS=$headInputStock->id;
       $orderPurchase = $this->orderPurchaseRepo->find($request->input('id'));
       $orderPurchase->detPres()->detach();
      
       foreach($var as $object){
      //  if($queHacer===0){
            //var_dump("hola");die();
        $detPres=$this->detPresRepo->listarVariantes($object['detPres_id']);

        $object["variant_id"]=$detPres->variant_id;
        
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
            $object['headInputStock_id']=$codigoHeadIS;
            $inserInputStock = new inputStockManager($inputStock,$object);
            $inserInputStock->save();
          
        

        $stockmodel = new StockRepo;
                  $object['warehouse_id']=$almacen_id;
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
                  //var_dump($object["tipo"]);die();
            if(!empty($stockac)){ 
               /* if($object["esbase"]==0){
                    if($object["tipo"]=="Salida"){
                        $object["stockActual"]=$stockac->stockActual-($object["cantidad_llegado"]*$object["equivalencia"]);
                        var_dump("entre");
                    }else{
                        $object["stockActual"]=$stockac->stockActual+($object["cantidad_llegado"]*$object["equivalencia"]);
                     }
                }else{
                    if($object["tipo"]=="Salida"){
                      $object["stockActual"]=$stockac->stockActual-$object["cantidad_llegado"];
                      var_dump("entre");
                    }else{
                       $object["stockActual"]=$stockac->stockActual+$object["cantidad_llegado"]; 
                    }
                }*/
                if($object["esbase"]==0){
                  $object["stockActual"]=$stockac->stockActual+($object["cantidad_llegado"]*$object["equivalencia"]);
                }else{
                  $object["stockActual"]=$stockac->stockActual+$object["cantidad_llegado"];
                }
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
            }else{
              if($tipo!=$tipo2){
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
            }
            $stockac=null;
        }}

       }}else{

       //==========================================================0
       //$inputStock = $this->inputStockRepo->getModel();
       $headInputStock = $this->headInputStockRepo->getModel();
          //var_dump($var);die();
        //if(!empty($var["cantidad_llegado"])){
            //var_dump($request->all());die();
            $inserHeadInputStock = new HeadInputStockManager($headInputStock,$request->all());
            $inserHeadInputStock->save();
            $codigoHeadIS=$headInputStock->id;
    foreach($var as $object){
          $inputStock = $this->inputStockRepo->getModel();
          //$inputStock = $this->inputStockRepo->getModel();
        if(!empty($object["cantidad_llegado"])){
          if($object["cantidad_llegado"]>0){
            $object['warehouse_id']=$almacen_id;
            $object['headInputStock_id']=$codigoHeadIS;
            $inserInputStock = new InputStockManager($inputStock,$object);
             
            $inserInputStock->save();
          //var_dump($object);die();
        

        $stockmodel = new StockRepo;
                  //$var['warehouse_id']=$almacen_id;
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
                  
            if(!empty($stockac)){ 
                
                if($object["esbase"]==0){
                    if($tipo==$tipo2){
                        $object["stockActual"]=$stockac->stockActual-($object["cantidad_llegado"]*$object["equivalencia"]);
                        var_dump("entre");
                    }else{
                        $object["stockActual"]=$stockac->stockActual+($object["cantidad_llegado"]*$object["equivalencia"]);
                     }
                }else{
                    if($tipo==$tipo2){
                      $object["stockActual"]=$stockac->stockActual-$object["cantidad_llegado"];
                      var_dump("entre");
                    }else{
                       $object["stockActual"]=$stockac->stockActual+$object["cantidad_llegado"]; 
                    }
                }
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
            }else{
              if($tipo!=$tipo2){
                if($object["esbase"]==0)
                {
                    $object["stockActual"]=$object["cantidad_llegado"]*$object["equivalencia"];
                }else{
                    $object["stockActual"]=$object["cantidad_llegado"];
                }
                  $manager = new StockManager($stockmodel->getModel(),$object);
                  $manager->save();
                  $stockmodel = null;
            }}
            $stockac=null;
        }}}}
       ////======================================================00
       return response()->json(['estado'=>true]);

    }
}