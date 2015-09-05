<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PaymentRepo;
use Salesfly\Salesfly\Managers\PaymentManager;
use Salesfly\Salesfly\Repositories\DetPaymentRepo;
use Salesfly\Salesfly\Managers\DetPaymentManager;

class PaymentsController extends Controller {

    protected $paymentRepo;

    public function __construct(PaymentRepo $paymentRepo,DetPaymentRepo $detPaymentRepo)
    {
        $this->paymentRepo = $paymentRepo;
        $this->detPaymentRepo = $detPaymentRepo;
    }

    public function create(Request $request)
    {
        //var_dump($request->all());die();
        $var=$request->detPayments;
      // var_dump($var);die();
        $payment = $this->paymentRepo->getModel();
        $detPayment = $this->detPaymentRepo->getModel();
        $provicional;
        if($request->idpayment==null){
        $manager = new PaymentManager($payment,$request->all());
        $manager->save();
        $provicional=$payment->id;
        }else{
            $payment1 = $this->paymentRepo->find($request->idpayment);
           $manager = new PaymentManager($payment1,$request->all());
           $manager->save(); 
           $provicional=$request->idpayment;
        }
        $var['tipoPago']='A';
        $var['payment_id']=$provicional;
        $insertDetP = new DetPaymentManager($detPayment,$var);
        $insertDetP->save();


        return response()->json(['estado'=>true, 'nombre'=>$payment->id]);
    }

    public function find($id)
    {
        $payment = $this->paymentRepo->paymentById($id);
        return response()->json($payment);
    }

    public function edit(Request $request)
    {
        $var=$request->detPayments;
        $detPayment= $this->detPaymentRepo->find($request->detpId);
        $detpay = new DetPaymentManager($detPayment,$var);
        $detpay->save();
        //$pagoTemporal=$detPayment->montoPagado;
        //$detPayment->delete();
        //$MontotalTemp=$request->input('MontoTotal');
       // $AcuentaTemp=$request->input('Acuenta');
        
        //$request->merge(['Acuenta'=>$AcuentaTemp-$pagoTemporal]);
        //$AcuentaTemp2=$request->input('Acuenta');
        //$request->merge(['Saldo'=>$MontotalTemp-$AcuentaTemp2]);
        //var_dump($request->all());die();
        $payment = $this->paymentRepo->find($request->id);
        $manager = new PaymentManager($payment,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$payment->nombre]); 
    }
  public function destroy(Request $request)
    {
        
        $detPayment= $this->detPaymentRepo->find($request->detpId);
        $pagoTemporal=$detPayment->montoPagado;
        $detPayment->delete();
        $MontotalTemp=$request->input('MontoTotal');
        $AcuentaTemp=$request->input('Acuenta');
        
        $request->merge(['Acuenta'=>$AcuentaTemp-$pagoTemporal]);
        $AcuentaTemp2=$request->input('Acuenta');
        $request->merge(['Saldo'=>$MontotalTemp-$AcuentaTemp2]);
        //var_dump($request->all());die();
        $payment = $this->paymentRepo->find($request->id);
        $manager = new PaymentManager($payment,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$payment->nombre]);
    }
    public function payIDLocal($id){
        $payment = $this->paymentRepo->payIDLocal($id);
        return response()->json($payment);
    }
}