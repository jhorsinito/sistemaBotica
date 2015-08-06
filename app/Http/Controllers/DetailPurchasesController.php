<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetailPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailPurchaseManager;

class DetailPurchaseController extends Controller {

    protected $detailPurchaseRepo;

    public function __construct(DetailPurchaseRepo $detailPurchaseRepo)
    {
        $this->detailPurchaseRepo = $detailPurchaseRepo;
    }


    public function index()
    {
        return View('detailPurchase.index');
        //return 'hola';
    }

    public function all()
    {
        $detailPurchases = $this->detailPurchaseRepo->paginate(15);
        return response()->json($detailPurchases);
        //var_dump($materials);
    }

    public function paginatep(){
        $detailPurchases = $this->detailPurchaseRepo->paginate(15);
        return response()->json($detailPurchases);
    }


    public function form_create()
    {
        return View('detailPurchasesdetailPurchases.form_create');
    }

    public function form_edit()
    {
        return View('detailPurchasesdetailPurchases.form_edit');
    }

    public function create(Request $request)
    {

        $detailPurchases = $this->detailPurchaseRepo->getModel();

        $manager = new DetailPurchaseManager($detailPurchases,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'descuento'=>$detailPurchases->descuento]);
    }

    public function find($id)
    {
        $detailPurchases = $this->detailPurchaseRepo->find($id);
        return response()->json($detailPurchases);
    }

    public function edit(Request $request)
    {
        $detailPurchases = $this->detailPurchaseRepo->find($request->id);

        $manager = new DetailPurchaseManager($detailPurchases,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'descuento'=>$detailPurchases->descuento]);
    }

    public function destroy(Request $request)
    {
        $detailPurchases= $this->detailPurchaseRepo->find($request->id);
        $detailPurchases->delete();

        return response()->json(['estado'=>true, 'nombre'=>$detailPurchases->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $detailPurchases = $this->detailPurchaseRepo->search($q);

        return response()->json($detailPurchases);
    }
}