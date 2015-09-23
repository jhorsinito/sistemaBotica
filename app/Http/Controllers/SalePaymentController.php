<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\SalePaymentRepo;
use Salesfly\Salesfly\Managers\SalePaymentManager;

class SalePaymentController extends Controller {

    protected $salePaymentRepo;

    public function __construct(SalePaymentRepo $salePaymentRepo)
    {
        $this->salePaymentRepo = $salePaymentRepo;
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
}