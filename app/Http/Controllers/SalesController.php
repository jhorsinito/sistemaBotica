<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\SaleRepo;
use Salesfly\Salesfly\Managers\SaleManager;

use Salesfly\Salesfly\Repositories\OrderSaleRepo;
use Salesfly\Salesfly\Managers\OrderSaleManager;

use Salesfly\Salesfly\Repositories\DetOrderSaleRepo;
use Salesfly\Salesfly\Managers\DetOrderSaleManager;

use Salesfly\Salesfly\Repositories\SeparateSaleRepo;
use Salesfly\Salesfly\Managers\SeparateSaleManager;

use Salesfly\Salesfly\Repositories\DetSeparateSaleRepo;
use Salesfly\Salesfly\Managers\DetSeparateSaleManager;

use Salesfly\Salesfly\Repositories\DetSaleRepo;
use Salesfly\Salesfly\Managers\DetSaleManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

use Salesfly\Salesfly\Managers\SalePaymentManager;
use Salesfly\Salesfly\Repositories\SalePaymentRepo;

use Salesfly\Salesfly\Managers\DetCashManager;
use Salesfly\Salesfly\Repositories\DetCashRepo;

use Salesfly\Salesfly\Managers\SaleDetPaymentManager;
use Salesfly\Salesfly\Repositories\SaleDetPaymentRepo;
use Salesfly\Salesfly\Managers\StockManager;
use Salesfly\Salesfly\Repositories\StockRepo;
class SalesController extends Controller
{
    protected $saleRepo;

    public function __construct(SaleRepo $saleRepo)
    {
        $this->saleRepo = $saleRepo;
    }

    public function all()
    {
        $orders = $this->saleRepo->paginate(15);
        return response()->json($orders);
        //var_dump($materials);
    }

    public function paginatep(){
        $orders = $this->saleRepo->paginate(15);
        return response()->json($orders);
    }

    public function find($id)
    {
        $cash = $this->saleRepo->find($id);
        return response()->json($cash);
    }

    public function search($q)
    {
        $orders = $this->saleRepo->search($q);

        return response()->json($orders);
    }
    public function index()
    {
        return View('sales.index');
    }
    public function form_create()
    {
        return View('sales.form_create');
    }
    public function form_edit()
    {
        return View('sales.form_edit');
    }

    public function create(Request $request) 
        {
        $orderSale = $this->saleRepo->getModel();

        $var = $request->detOrders;
        //var_dump($var);die();
        $payment = $request->salePayment;
        $saledetPayments = $request->saledetPayments;

        //$almacen_id=$var->input("idAlmacen");
        //$variante_id=$var->input("vari");
        
        $manager = new SaleManager($orderSale,$request->all());
        $manager->save();
        /*
       if($this->purchaseRepo->validateDate(substr($request->input('fechaEntrega'),0,10))){
            $order->fechaEntrega = substr($request->input('fechaEntrega'),0,10);
        }else{
           
            $order->fechaEntrega = null;
        }*/ 
        $orderSale->save();

        $temporal=$orderSale->id;

        //---create movimiento---
            $movimiento = $request->movimiento;
            $detCashrepo;
            $movimiento['observacion']=$temporal;
            $detCashrepo = new DetCashRepo;
            $movimientoSave=$detCashrepo->getModel();
        
            $insertarMovimiento=new DetCashManager($movimientoSave,$movimiento);
            $insertarMovimiento->save();
    //---Autualizar Caja---
            
            $cajaAct = $request->caja;
            $cashrepo;
            //$movimiento['observacion']=$temporal;
            $cashrepo = new CashRepo;
            $cajaSave=$cashrepo->getModel();
            //var_dump($cajaAct);die();
            $cash1 = $cashrepo->find($cajaAct["id"]);


        
            //$insertarMovimiento=new DetCashManager($movimientoSave,$movimiento);
            //$insertarMovimiento->save();

            //$stores = $this->storeRepo->find($request->id);
            //var_dump($cash1);die();

            $manager1 = new CashManager($cash1,$cajaAct);
            $manager1->save();
            

        //----------------
        $salePaymentrepo;
        $payment['sale_id']=$temporal;
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
           $object['sale_id'] = $temporal;

           $detOrderrepox = new DetSaleRepo;

           $insertar=new DetSaleManager($detOrderrepox->getModel(),$object);
           $insertar->save();
          
           $detOrderrepox = null;

           //-------------------------------------
           
           $stockmodel = new StockRepo;
                  $object['warehouse_id']=$object['idAlmacen'];
                  $object["variant_id"]=$object['vari'];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$object['warehouse_id']);
                  //var_dump($stockac);die();
            if(!empty($stockac)){
             
                if($object["equivalencia"]==null){
                  $object["stockActual"]=$stockac->stockActual-($object["cantidad"]);//
                  
                }else{
                  $object["stockActual"]=$stockac->stockActual-($object["cantidad"]*$object["equivalencia"]);
                  
                }
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  //$stock=null;
            }else{
                
            }
            $stockac=null;
            //-----------------------------------------------------
       }
     return response()->json(['estado'=>true, 'nombres'=>$orderSale->nombres]);
    }


    public function createSeparateSale(Request $request) 
        {
          
          //---------------------- 
          $orderRepo;
            $orderRepo = new SeparateSaleRepo;
            $cajaSave=$orderRepo->getModel();
            $cash1 = $orderRepo->find($request->id);

            $manager1 = new SeparateSaleManager($cash1,$request->all());
            $manager1->save();
        //---------------------
        $var = $request->detOrders;
        $request->merge(array('estado' => '0'));
        //$request->merge(array('estado' => '0'));
        $orderSale = $this->saleRepo->getModel();
        $manager = new SaleManager($orderSale,$request->all());
        $manager->save();
 
        $orderSale->save();
        $temporal=$orderSale->id;
        
          //----------------------      

        $detOrderrepox;
        $montoventa=0;
       foreach($var as $object){
          //------Actualizar pedido------
          //$cajaAct = $request->caja;
          //var_dump($object);die();
            $saleDet;
            $saleDet = new DetSeparateSaleRepo;
            //$object=$saleDet->getModel();
            
            $saled = $saleDet->find($object['id'] );
            //var_dump($saled);die();

            $manager2 = new DetSeparateSaleManager($saled,$object);
            $manager2->save();
          //-----------------------------
           $object['sale_id'] = $temporal;
           $object['cantidad'] = $object['parteEntregado'];
           $object['subTotal'] = $object['precioVenta']*$object['parteEntregado'];
           $montoventa=$montoventa+$object['subTotal'];
           $detOrderrepox = new DetSaleRepo;

           $insertar=new DetSaleManager($detOrderrepox->getModel(),$object);
           if($object['parteEntregado']>0){$insertar->save();}
           
          
           $detOrderrepox = null;

           //-------------------------------------
           
           $stockmodel = new StockRepo;
                  $object['warehouse_id']=$object['idAlmacen'];
                  $object["variant_id"]=$object['vari'];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$object['warehouse_id']);
                  //var_dump($stockac);die();
            if(!empty($stockac)){
             
                if($object["equivalencia"]==null){
                  $object["stockSeparados"]=$stockac->stockSeparados-($object["cantidad"]);
                  $object["stockActual"]=$stockac->stockActual-($object["cantidad"]);//
                  
                }else{
                  $object["stockActual"]=$stockac->stockActual-($object["cantidad"]*$object["equivalencia"]);
                  $object["stockSeparados"]=$stockac->stockSeparados-($object["cantidad"]*$object["equivalencia"]);
                }
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  //$stock=null;
            }else{
                
            }
            $stockac=null;
            //-----------------------------------------------------
       }
            $subTotal=$montoventa/1.18;
            $montoIgv=$montoventa-$subTotal;

            $request->merge(array('montoTotal' => $montoventa));
            $request->merge(array('igv' => $montoIgv));
            $request->merge(array('montoBruto' => $subTotal));

            $sales=$this->saleRepo->find($temporal);
            $manager = new SaleManager($sales,$request->all());
            $manager->save();
     return response()->json(['estado'=>true, 'nombres'=>$orderSale->nombres]);
    }

    public function createSale(Request $request) 
        {
          
          //---------------------- 
          $orderRepo;
            $orderRepo = new OrderSaleRepo;
            $cajaSave=$orderRepo->getModel();
            $cash1 = $orderRepo->find($request->id);

            $manager1 = new OrderSaleManager($cash1,$request->all());
            $manager1->save();
        //---------------------
        $var = $request->detOrders;
        $request->merge(array('estado' => '0'));
        //$request->merge(array('estado' => '0'));
        $orderSale = $this->saleRepo->getModel();
        $manager = new SaleManager($orderSale,$request->all());
        $manager->save();
 
        $orderSale->save();
        $temporal=$orderSale->id;
        
          //----------------------      

        $detOrderrepox;
        $montoventa=0;
       foreach($var as $object){
          //------Actualizar pedido------
          //$cajaAct = $request->caja;
          //var_dump($object);die();
            $saleDet;
            $saleDet = new DetOrderSaleRepo;
            //$object=$saleDet->getModel();
            
            $saled = $saleDet->find($object['id'] );
            //var_dump($saled);die();

            $manager2 = new DetOrderSaleManager($saled,$object);
            $manager2->save();
          //-----------------------------
           $object['sale_id'] = $temporal;
           $object['cantidad'] = $object['parteEntregado'];
           $object['subTotal'] = $object['precioVenta']*$object['parteEntregado'];
           $montoventa=$montoventa+$object['subTotal'];
           $detOrderrepox = new DetSaleRepo;

           $insertar=new DetSaleManager($detOrderrepox->getModel(),$object);
           if($object['parteEntregado']>0){$insertar->save();}
           
          
           $detOrderrepox = null;

           //-------------------------------------
           
           $stockmodel = new StockRepo;
                  $object['warehouse_id']=$object['idAlmacen'];
                  $object["variant_id"]=$object['vari'];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$object['warehouse_id']);
                  //var_dump($stockac);die();
            if(!empty($stockac)){
             
                if($object["equivalencia"]==null){
                  $object["stockPedidos"]=$stockac->stockPedidos-($object["cantidad"]);
                  $object["stockActual"]=$stockac->stockActual-($object["cantidad"]);//
                  
                }else{
                  $object["stockActual"]=$stockac->stockActual-($object["cantidad"]*$object["equivalencia"]);
                  $object["stockPedidos"]=$stockac->stockPedidos-($object["cantidad"]*$object["equivalencia"]);
                }
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  //$stock=null;
            }else{
                
            }
            $stockac=null;
            //-----------------------------------------------------
       }
            $subTotal=$montoventa/1.18;
            $montoIgv=$montoventa-$subTotal;

            $request->merge(array('montoTotal' => $montoventa));
            $request->merge(array('igv' => $montoIgv));
            $request->merge(array('montoBruto' => $subTotal));

            $sales=$this->saleRepo->find($temporal);
            $manager = new SaleManager($sales,$request->all());
            $manager->save();
     return response()->json(['estado'=>true, 'nombres'=>$orderSale->nombres]);
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
