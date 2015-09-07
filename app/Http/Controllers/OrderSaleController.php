<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\OrderSaleRepo;
use Salesfly\Salesfly\Managers\OrderSaleManager;

class OrderSaleController extends Controller {

    protected $orderSaleRepo;

    public function __construct(OrderSaleRepo $orderSaleRepo)
    {
        $this->orderSaleRepo = $orderSaleRepo;
    }

    public function index() 
    {
        return View('orderSales.index');
    }

    public function all()
    {
        $orderSales = $this->orderSaleRepo->paginate(15);
        return response()->json($orderSales);
        //var_dump($orderSales);
    }

    public function paginatep(){
        $orderSales = $this->orderSaleRepo->paginate(15);
        return response()->json($orderSales);
    }


    public function form_create()
    {
        return View('orderSales.form_create');
    }

    public function form_edit()
    {
        return View('orderSales.form_edit');
    }
/*
    public function create(Request $request)
    {
        $orderSales = $this->orderSaleRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new MaterialManager($orderSales,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.material',$material->all());

        return response()->json(['estado'=>true, 'nombre'=>$orderSales->nombre]);
    }
*/

    public function find($id)
    {
        $material = $this->orderSaleRepo->find($id);
        return response()->json($material);
    }
/*
    public function edit(Request $request)
    {
        $material = $this->orderSaleRepo->find($request->id);
        //var_dump($material);
        //die(); 
        $manager = new MaterialManager($material,$request->all());
        $manager->save();

        //Event::fire('update.material',$material->all());
        return response()->json(['estado'=>true, 'nombre'=>$material->nombre]);
    }

    public function destroy(Request $request)
    {
        $material= $this->orderSaleRepo->find($request->id);
        $material->delete();
        //Event::fire('update.material',$material->all());
        return response()->json(['estado'=>true, 'nombre'=>$material->nombre]);
    }
    */

    public function search($q)
    {
        //$q = Input::get('q');
        $orderSales = $this->orderSaleRepo->search($q);

        return response()->json($orderSales);
    }
}