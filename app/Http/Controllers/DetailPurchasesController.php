<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetailPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailPurchaseManager;

class DetailPurchasesController extends Controller {

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

    public function paginatep($id){
        $detailPurchases =$this->detailPurchaseRepo->paginate($id);
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
  
  $var = $request->all();
  $detailPurchaseRepox;
         
       foreach($var as $object){

           $detailPurchaseRepox = new DetailPurchaseRepo;
           $insertar=new DetailPurchaseManager($detailPurchaseRepox->getModel(),$object);
           $insertar->save();
           $detailPurchaseRepox = null;
       }
      return response()->json(['estado'=>true]);
    }
    public function destroy(Request $request)
    {
      
           $detailPurchases= $this->detailPurchaseRepo->find($request->id);
        $detailPurchases->delete();
       
      return response()->json(['estado'=>true]);
        
    }
    public function Eliminar($id){
         $detailPurchases = $this->detailPurchaseRepo->Eliminar($id);
        return response()->json($detailPurchases);
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

    

    public function search($q)
    {
        //$q = Input::get('q');
        $detailPurchases = $this->detailPurchaseRepo->search($q);

        return response()->json($detailPurchases);
    }
}