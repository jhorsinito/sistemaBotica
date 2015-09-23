<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\SalePaymentRepo;
use Salesfly\Salesfly\Managers\SalePaymentManager;

use Salesfly\Salesfly\Repositories\SaleDetPaymentRepo;
use Salesfly\Salesfly\Managers\SaleDetPaymentManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

use Salesfly\Salesfly\Repositories\DetCashRepo;
use Salesfly\Salesfly\Managers\DetCashManager;

class SalePaymentController extends Controller {

    protected $salePaymentRepo;

    public function __construct(SalePaymentRepo $salePaymentRepo,SaleDetPaymentRepo $saleDetPaymentRepo,DetCashRepo $detCashRepo,cashRepo $cashRepo)
    {
        $this->salePaymentRepo = $salePaymentRepo;
        $this->saleDetPaymentRepo = $saleDetPaymentRepo;
        $this->detCashRepo=$detCashRepo;
        $this->cashRepo=$cashRepo;
    }

    public function searchPayment($id)
    {
        //$q = Input::get('q');
        $detOrder = $this->salePaymentRepo->searchPayment($id);

        return response()->json($detOrder);
    }
    public function searchPaymentOrder($id)
    {
        //$q = Input::get('q');
        $detOrder = $this->salePaymentRepo->searchPaymentOrder($id);

        return response()->json($detOrder);
    }
    public function searchPaymentSeparate($id)
    {
        //$q = Input::get('q');
        $detOrder = $this->salePaymentRepo->searchPaymentSeparate($id);

        return response()->json($detOrder);
    }
    public function edit(Request $request)
    {
        //var_dump($request->all());die();
        $payment = $this->salePaymentRepo->find($request->id);
        $manager = new SalePaymentManager($payment,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$payment->nombre]);
    }
    public function destroy(Request $request) 
    {
        //var_dump($request->all());die();
        $detPayment=$this->saleDetPaymentRepo->find($request->detpayment_id);

        $pagoTemporal=$detPayment->monto;
        $detPayment->delete();

        $MontotalTemp=$request->input('MontoTotal');
        $AcuentaTemp=$request->input('Acuenta');
        
        $request->merge(['Acuenta'=>$AcuentaTemp-$pagoTemporal]);
        $AcuentaTemp2=$request->input('Acuenta');
        $request->merge(['Saldo'=>$MontotalTemp-$AcuentaTemp2]);

        $payment = $this->salePaymentRepo->find($request->id);

        $manager = new SalePaymentManager($payment,$request->only("Acuenta","Saldo"));
        $manager->save();

        if(intval($request->input('detCash_id'))==true){
            
            $detcash=$this->detCashRepo->find($request->input("detCash_id"));
            $cash=$this->cashRepo->find($detcash->cash_id);
            
             $request->merge(["gastos"=>floatval($cash->gastos)-floatval($pagoTemporal)]);
             $request->merge(['montoBruto'=>floatval($cash->montoBruto)+floatval($pagoTemporal)]);
             $request->merge(['fechaInicio'=>$cash->fechaInicio]);
             $request->merge(['fechaFin'=>$cash->fechaFin]);
             $request->merge(['montoInicial'=>$cash->montoInicial]);
             $request->merge(['ingresos'=>$cash->ingresos]);
             //$request->merge(['montoBruto'=>$cash->montoBruto]);
             $request->merge(['montoReal'=>$cash->montoReal]);
             $request->merge(['descuadre'=>$cash->descuadre]);
             $request->merge(['estado'=>$cash->estado]);
             $request->merge(['notas'=>$cash->notas]);
             $request->merge(['cashHeader_id'=>$cash->cashHeader_id]);
            $cashr = new CashManager($cash,$request->all());
            $cashr->save();
            $detcash->delete();
        }
       
        return response()->json(['estado'=>true, 'nombre'=>$payment->nombre]);
    }
}