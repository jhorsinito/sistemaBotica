<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\OrderRepo;
use Salesfly\Salesfly\Managers\OrderManager;

use Salesfly\Salesfly\Repositories\DetOrderRepo;
use Salesfly\Salesfly\Managers\DetOrderManager;

use Salesfly\Salesfly\Managers\SalePaymentManager;
use Salesfly\Salesfly\Repositories\SalePaymentRepo;

use Salesfly\Salesfly\Managers\SaleDetPaymentManager;
use Salesfly\Salesfly\Repositories\SaleDetPaymentRepo;
use Salesfly\Salesfly\Managers\StockManager;
use Salesfly\Salesfly\Repositories\StockRepo;
class OrdersController extends Controller
{
    protected $orderRepo;

    public function __construct(OrderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function all()
    {
        $orders = $this->orderRepo->paginate(15);
        return response()->json($orders);
        //var_dump($materials);
    }

    public function paginatep(){
        $orders = $this->orderRepo->paginate(15);
        return response()->json($orders);
    }

    public function find($id)
    {
        $cash = $this->orderRepo->find($id);
        return response()->json($cash);
    }

    public function search($q)
    {
        $orders = $this->orderRepo->search($q);

        return response()->json($orders);
    }
    public function index()
    {
        return View('orders.index');
    }
    public function form_create()
    {
        return View('orders.form_create');
    }
    public function form_edit()
    {
        return View('orders.form_edit');
    }

    public function create(Request $request)
        {
        $order = $this->orderRepo->getModel();

        $var = $request->detOrders;
        //var_dump($var);die();
        $payment = $request->salePayment;
        $saledetPayments = $request->saledetPayments;

        $almacen_id=$request->input("idAlmacen");
        $variante_id=$request->input("vari");
        
        $manager = new OrderManager($order,$request->all());
        $manager->save();
        /*
       if($this->purchaseRepo->validateDate(substr($request->input('fechaEntrega'),0,10))){
            $order->fechaEntrega = substr($request->input('fechaEntrega'),0,10);
        }else{
           
            $order->fechaEntrega = null;
        }*/ 
        $order->save();

        $temporal=$order->id;
        //----------------
        $salePaymentrepo;
        $payment['order_id']=$temporal;
        $salePaymentrepo = new SalePaymentRepo;
        $paymentSave=$salePaymentrepo->getModel();
        
        $insertarpayment=new SalePaymentManager($paymentSave,$payment);
        $insertarpayment->save();          
        $paymentSave->save();

        $temporal1=$paymentSave->id;
            //--------------------------
                $saledetPaymentrepo;
                foreach($saledetPayments as $object1){
                    $object1['salePayment_id'] = $temporal1;

                    $saledetPaymentrepo = new SaleDetPaymentRepo;

                    $insertar=new SaleDetPaymentManager($saledetPaymentrepo->getModel(),$object1);
                    $insertar->save();
          
                    $saledetPaymentrepo = null;
                }
            //--------------------------

        //----------------

        $detOrderrepox;
         
       foreach($var as $object){
           $object['order_id'] = $temporal;

           $detOrderrepox = new DetOrderRepo;

           $insertar=new DetOrderManager($detOrderrepox->getModel(),$object);
           $insertar->save();
          
           $detOrderrepox = null;

           //-------------------------------------
           
           $stockmodel = new StockRepo;
                  $object['warehouse_id']=$almacen_id;
                  $object["variant_id"]=$variante_id;
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
                  
            if(!empty($stockac)){ 
                //if($object["esbase"]==0){
                  $object["stockActual"]=$stockac->stockActual+($object["cantidad"]);//*$object["equivalencia"]
                //}else{
                  //$object["stockActual"]=$stockac->stockActual+$object["cantidad"];
                //}
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
            }else{
                
            }
            $stockac=null;
            //-----------------------------------------------------
       }
     return response()->json(['estado'=>true, 'nombres'=>$order->nombres]);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
