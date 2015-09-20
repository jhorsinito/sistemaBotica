<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\SaleDetPaymentRepo;
use Salesfly\Salesfly\Managers\SaleDetPaymentManager;
use Salesfly\Salesfly\Repositories\SalePaymentRepo;
use Salesfly\Salesfly\Managers\SalePaymentManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

use Salesfly\Salesfly\Repositories\DetCashRepo;
use Salesfly\Salesfly\Managers\DetCashManager;

use Salesfly\Salesfly\Repositories\SaleRepo;
use Salesfly\Salesfly\Managers\SaleManager;

class SaleDetPaymentController extends Controller {

    protected $saleDetPaymentRepo;
    //protected $salePaymentRepo;

    public function __construct(SaleDetPaymentRepo $saleDetPaymentRepo)
    {
        $this->saleDetPaymentRepo = $saleDetPaymentRepo;
        //$this->salePaymentRepo = $salePaymentRepo;
    }



    

    public function searchDetalle($id)
    {
        //$q = Input::get('q');
        $saleDetPayment = $this->saleDetPaymentRepo->searchDetalle($id);

        return response()->json($saleDetPayment);
    }

    //------------------------------------------------------
    public function create(Request $request)
    {
        //var_dump($request->input("Saldo"));die();
        $saldo=$request->input("Saldo");
        $temporal=$request->input("sale_id");
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
            $temporal2=$cajaAct['id'];
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
        
        $var=$request->detPayments;
        
        $temporal=$var["salePayment_id"];

        $salePaymentrepo;

        $salePaymentrepo = new SalePaymentRepo;
        $paymentSave=$salePaymentrepo->getModel();

        $payment1 = $paymentSave->find($temporal);
        //if($saldo=='0'){$request->input("estado")='0';}
        $manager = new SalePaymentManager($payment1,$request->all());
        $manager->save();

        //------------------------------------

        $var1=$request->sale;
        
        $saleTemporal=$var1["id"];

        $salerepo;

        $salerepo = new SaleRepo;
        $saleSave=$salerepo->getModel();

        $saleEdit = $saleSave->find($saleTemporal);
        if($saldo=='0'){$var1['estado']='0';}
        $manager = new SaleManager($saleEdit,$var1);
        $manager->save();

        //------------------------------------


        $detPayment = $this->saleDetPaymentRepo->getModel();
        $detPayment['numCaja']=$temporal2;


        $manager = new SaleDetPaymentManager($detPayment,$request->detPayments);
        $manager->save();
       /* if($this->detPaymentRepo->validateDate(substr($request->exedetPayments['fecha'],0,10))){
            $request->detPayments['fecha'] = substr($request->detPayments['fecha'],0,10);
        }else{
           
            $request->detPayments['fecha'] = null;
        }*/
       // $detPayment->save();
        return response()->json(['estado'=>true, 'montoP'=>$detPayment->Acuenta]);
    }
    public function find($id)
    {
        $detPayment = $this->saleDetPaymentRepo->mostrarDetPayment($id);
        return response()->json($detPayment);
    }

    public function edit(Request $request)
    {
        $detPayment = $this->detPaymentRepo->find($request->id);
        $manager = new DetPaymentManager($detPayment,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$detPayment->nombre]);
    }
//------------------------------------------------------
}