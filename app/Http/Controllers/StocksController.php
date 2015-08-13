<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;

class StocksController extends Controller {

    protected $stockRepo;

    public function __construct(StockRepo $stockRepo)
    {
        $this->stockRepo = $stockRepo;
    }

    

    public function all()
    {
        $stocks = $this->stockRepo->paginate(15);
        return response()->json($stocks);
        //var_dump($stocks);
    }


    public function create(Request $request)
    {
        $stocks = $this->stockRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new StationManager($stocks,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.stock',$stock->all());

        return response()->json(['estado'=>true, 'nombre'=>$stocks->nombre]);
    }

    public function find($id)
    {
        $stock = $this->stockRepo->find($id);
        return response()->json($stock);
    }

    public function edit(Request $request)
    {
         $var =$request->detailOrderPurchases;
         //var_dump($var); die();
         $almacen_id=$request->input("warehouses_id");
         $stockmodel = new StockRepo;
       foreach($var as $object){
           $object['warehouse_id']=$almacen_id;
           $object["variant_id"]=$object["Codigovar"];
           //var_dump($object["variant_id"]);die();
           $stockac=$this->stockRepo->encontrar($object["variant_id"]);
           
      if($stockac!= null){
         if($object["esbase"]==0){
                $object["stockActual"]=($object["cantidad"]+$stockac->stockActual)*$object["equivalencia"];
         }else{
                $object["stockActual"]=$object["cantidad"]+$stockac->stockActual;
         }
           $stock = $this->stockRepo->find($stockac->id);
           $manager = new StockManager($stock,$object);
           $manager->save();
     }else{
           $object["stockActual"]=$object["cantidad"];
           $manager = new TypeManager($stockmodel->getModel(),$object);
           $manager->save();
           $stockmodel = null;
          }

       }
      
        return response()->json(['estado'=>true]);
    }

    public function destroy(Request $request)
    {
        $stock= $this->stockRepo->find($request->id);
        $stock->delete();
        //Event::fire('update.stock',$stock->all());
        return response()->json(['estado'=>true, 'nombre'=>$stock->nombre]);
    }

   
}