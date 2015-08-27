<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetPaymentRepo;
use Salesfly\Salesfly\Managers\DetPaymentManager;
use Salesfly\Salesfly\Repositories\PaymentRepo;
use Salesfly\Salesfly\Managers\PaymentManager;

class DetPaymentsController extends Controller {

    protected $detPaymentRepo;

    public function __construct(DetPaymentRepo $detPaymentRepo,PaymentRepo $paymentRepo)
    {
        $this->detPaymentRepo = $detPaymentRepo;
        $this->paymentRepo=$paymentRepo;
    }

    public function paginatep(){
        $persons = $this->detPaymentRepo->paginate(5);
        return response()->json($persons);
    }
    public function create(Request $request)
    {
        //var_dump($request->all());die();;
        $var=$request->detPayments;
        //var_dump($var);die();
        $detPayment = $this->detPaymentRepo->getModel();
        $payment = $this->paymentRepo->find($request->id);
        $update = new PaymentManager($payment,$request->all());
        $update->save();
        $var['tipoPago']='P';
        $manager = new DetPaymentManager($detPayment,$var);
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
        $detPayment = $this->detPaymentRepo->mostrarDetPayment($id);
        return response()->json($detPayment);
    }

    public function edit(Request $request)
    {
        $detPayment = $this->detPaymentRepo->find($request->id);
        $manager = new DetPaymentManager($detPayment,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$detPayment->nombre]);
    }
 
}