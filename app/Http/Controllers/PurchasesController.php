<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PurchaseRepo;
use Salesfly\Salesfly\Managers\PurchaseManager;
use Salesfly\Salesfly\Repositories\DetailPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailPurchaseManager;
use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;

use Salesfly\Salesfly\Repositories\PaymentRepo;
use Salesfly\Salesfly\Managers\PaymentManager;

use Salesfly\Salesfly\Repositories\PendientAccountRepo;
use Salesfly\Salesfly\Managers\PendientAccountManager;

use Salesfly\Salesfly\Repositories\DetPaymentRepo;
use Salesfly\Salesfly\Managers\DetPaymentManager;

use Salesfly\Salesfly\Repositories\InputStockRepo;
use Salesfly\Salesfly\Managers\InputStockManager;

use Salesfly\Salesfly\Repositories\HeadInputStockRepo;
use Salesfly\Salesfly\Managers\HeadInputStockManager;
//use Intervention\Image\Facades\Image;

class PurchasesController extends Controller {

    protected $purchaseRepo;

   /** public function __construct(PurchaseRepo $purchaseRepo)
    {
        $this->purchaseRepo = $purchaseRepo;
    }*/

    public function __construct(HeadInputStockRepo $headInputStockRepo,InputStockRepo $inputStockRepo,DetPaymentRepo $detPaymentRepo,PendientAccountRepo $pendientAccountRepo,PaymentRepo $paymentRepo,DetailPurchaseRepo $detailPurchaseRepo, PurchaseRepo $purchaseRepo,StockRepo $stockRepo)
    {
        $this->detailPurchaseRepo = $detailPurchaseRepo;
        $this->purchaseRepo = $purchaseRepo;
        $this->stockRepo = $stockRepo;
        $this->paymentRepo=$paymentRepo;
        $this->pendientAccountRepo=$pendientAccountRepo;
        $this->detPaymentRepo=$detPaymentRepo;
        $this->inputStockRepo=$inputStockRepo;
        $this->headInputStockRepo=$headInputStockRepo;

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
   public function form_showD(){
     return View('purchases.showD');
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
         // var_dump($request->all());die();
        $saldoTemp=0;
        $codigoHeadIS=0;
        $purchase = $this->purchaseRepo->getModel();
        $payment = $this->paymentRepo->getModel();
        $pendientAccount=$this->pendientAccountRepo->getModel();
        $var = $request->detailOrderPurchases;
        $almacen_id=$request->input("warehouses_id");
        $codOrder=$request->input("orderPurchase_id");
        $fechaActual=$request->input("fecha");
        //=============================Creando compra =============================
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
       // return $temporal;
        $request->merge(["purchase_id"=>$temporal]);
        $detailPurchaseRepox;
        $consulPayment=null;
        //$almacen_id=$request->input("warehouses_id");
      //====================Creando y actualizando pagos si que existe adelantos====================================
        if($request->input('compraDirecta')==1){
          $request->merge(["Acuenta"=>0]);
          $inserPay=new PaymentManager($payment,$request->all());
          $inserPay->save();
          
        }else{
        $consulPayment=$this->paymentRepo->paymentById($purchase->orderPurchase_id);
        if($consulPayment==null){
          $request->merge(["Acuenta"=>0]);
          $inserPay=new PaymentManager($payment,$request->all());
          $inserPay->save();
          //------------------------------------
          

        }else{

              $request->merge(["Acuenta"=>$consulPayment->Acuenta]);
              $request->merge(["Saldo"=>(floatval($request->input("montoTotal"))-floatval($request->input("Acuenta")))]);
              $inserPay=new PaymentManager($consulPayment,$request->all());
              $inserPay->save();
              //$saldoTemp=$inserPay->Saldo;
        }
      }
        ///==========================Registrando saldo Afavor ========================================

       if($request->input('Saldo')<0){
           
            $request->merge(['Saldo'=>$request->input('Saldo')*-1]);
            $insercount=new PendientAccountManager($pendientAccount,$request->all());
            $insercount->save();
             
        }
       if($consulPayment!=null){
        $detPayment=$this->detPaymentRepo->verPagosAdelantados($consulPayment->id);
          if($detPayment!=null){       
          
          foreach($detPayment as $detPayment){

          if($detPayment->Saldo_F!=null){
               $saldos=$this->pendientAccountRepo->find2($detPayment['Saldo_F']);
            if($saldos!=null){
              if($saldos->Saldo==0){                
                 $request->merge(['Saldo'=>0]);
                 $request->merge(['estado'=>1]);
                 $request->merge(['orderPurchase_id'=>$saldos->orderPurchase_id]);
                 $request->merge(['supplier_id'=>$saldos->supplier_id]);
                 $insercount=new PendientAccountManager($saldos,$request->all());
                 $insercount->save();
              }
            }
            }
          }
       }}

      //========================================================================
       foreach($var as $object){
        //========================insertDEtalles=========================
           $object['orderPurchase_id']=$codOrder;
           $object['purchases_id'] = $temporal;
           $object['purchase_id']=$temporal;
           $object['Fecha']=$fechaActual;
           $detailPurchaseRepox = new DetailPurchaseRepo;
           $insertar=new DetailPurchaseManager($detailPurchaseRepox->getModel(),$object);
           $insertar->save();
           $detailPurchaseRepox = null;

           $stockmodel = new StockRepo;
                  $object['warehouse_id']=$almacen_id;
                  $object["variant_id"]=$object["Codigovar"];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
                  if(!empty($object["Cantidad_Ll"])){
                  $cantidaCalculada=$object["cantidad"]-$object["Cantidad_Ll"];
                  }else{ $cantidaCalculada=$object["cantidad"];}
        //======================Si Existe Stock Pendiente Por Agregar===============================
        if($cantidaCalculada>0){
          $inputStock = $this->inputStockRepo->getModel();
          $object["warehouses_id"]=$request->input("warehouses_id");
          $object["cantidad_llegado"]=$cantidaCalculada;
          $object['descripcion']='Entrada por compra';
          $object['tipo']='Entrada';
          //$request->merge(["orderPurchase_id"=>$request->input('id')]);
          ////======================Registrando en notas de cabecera===============================
               
          if($codigoHeadIS===0 && $cantidaCalculada>0){
               $headInputStock = $this->headInputStockRepo->getModel();
              // var_dump($object);die();
               $object["user_id"]=auth()->user()->id;
               $inserHeadInputStock = new HeadInputStockManager($headInputStock,$object);
               $inserHeadInputStock->save();
               $codigoHeadIS=$headInputStock->id;
               }
       ////======================Registrando en notas de detalles===============================
              $object['headInputStock_id']=$codigoHeadIS;
              $inserInputStock = new inputStockManager($inputStock,$object);
              $inserInputStock->save();
            if(!empty($stockac)){ 
                if($object["esbase"]==0){
                  $object["stockActual"]=$stockac->stockActual+($cantidaCalculada*$object["equivalencia"]);
                }else{
                  $object["stockActual"]=$stockac->stockActual+$cantidaCalculada;
                }
      //======================Actualizando stock si es que variante existe===============================
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
            }else{
                if($object["esbase"]==0)
                {
                    $object["stockActual"]=$cantidaCalculada*$object["equivalencia"];
                }else{
                    $object["stockActual"]=$cantidaCalculada;
                }
      //======================Registrando estock si es que variante no existe===============================
                  $manager = new StockManager($stockmodel->getModel(),$object);
                  $manager->save();
                  $stockmodel = null;
            }
            $stockac=null;
         }
       }
      //======================Creando reporte por cada linea de detalle de compra===============================
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_tikets';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/tikets.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['idVariante' => $temporal],//Parametros
              
            $database,
            false,
            false
        )->execute();
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
    public function show()
    {
        return View('purchases.show');
    }
}