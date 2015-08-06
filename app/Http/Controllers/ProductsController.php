<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Mockery\Matcher\Type;
use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;

use Salesfly\Salesfly\Repositories\ProductRepo;
use Salesfly\Salesfly\Managers\ProductManager;

use Salesfly\Salesfly\Entities\Brand;
use Salesfly\Salesfly\Entities\Ttype;
use Salesfly\Salesfly\Entities\Material;
use Salesfly\Salesfly\Entities\Station;

class ProductsController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepo $productRepo)
    {
        $this->productRepo = $productRepo;
        $this->middleware('auth');
        //$this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return View('products.index');
    }

    public function all()
    {
        $products = $this->productRepo->all();
        return response()->json($products);
        //var_dump($customers);
    }

    public function paginate(){
        $products = $this->productRepo->paginate(15);
        return response()->json($products);
    }


    public function form_create()
    {
        return View('products.form_create');
    }

    public function form_edit()
    {
        return View('products.form_edit');
    }

    public function create(Request $request)
    {
        $product = $this->productRepo->getModel();

        $manager = new ProductManager($product,$request->all());

        $manager->save();

        //if($request->input('hasVariants') === true){

        //}

        return response()->json(['estado'=>true, 'nombres'=>$product->nombre]);
    }

    public function show()
    {
        return View('products.show');
    }

    /*public function find($id)
    {
        $customer = $this->customerRepo->find($id);
        return response()->json($customer);
    }

    public function edit(Request $request)
    {
        $customer = $this->customerRepo->find($request->id);
        //var_dump($request->except('fechaNac'));
        //die();
        $manager = new CustomerManager($customer,$request->except('fechaNac'));
        $manager->save();
        if($this->customerRepo->validateDate(substr($request->input('fechaNac'),0,10))){
            //$customer->fechaNac = date("Y-m-d", strtotime($request->input('fechaNac')));
            $customer->fechaNac = substr($request->input('fechaNac'),0,10);
            $customer->save();
        }

        //Event::fire('update.customer',$customer->all());
        return response()->json(['estado'=>true, 'nombre'=>$customer->nombre]);
    }

    public function destroy(Request $request)
    {
        $customer= $this->customerRepo->find($request->id);
        $customer->delete();
        //Event::fire('update.customer',$customer->all());
        return response()->json(['estado'=>true, 'nombre'=>$customer->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $customers = $this->customerRepo->search($q);

        return response()->json($customers);
    }*/
    public function brands_select(){
        $brands = Brand::lists('nombre','id');
        return response()->json($brands);
    }
    public function materials_select(){
        $materials = Material::lists('nombre','id');
        return response()->json($materials);
    }
    public function types_select(){
        $types = Ttype::lists('nombre','id');
        return response()->json($types);
    }
    public function stations_select(){
        $stations = Station::lists('nombre','id');
        return response()->json($stations);
    }
    public function selectProducts(){
        $products = $this->productRepo->all();
        return response()->json($products);
    }
}
