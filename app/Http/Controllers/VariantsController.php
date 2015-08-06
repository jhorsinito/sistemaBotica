<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\VariantRepo;
use Salesfly\Salesfly\Managers\VariantManager;

class VariantsController extends Controller {

    protected $variantRepo;

    public function __construct(VariantRepo $variantRepo)
    {
        $this->variantRepo = $variantRepo;
    }

    public function index()
    {

        return View('variants.index');
    }

    public function all()
    {
        $variants = $this->variantRepo->paginate(15);
        return response()->json($variants);
        //var_dump($variants);
    }

    public function paginatep(){ //->with(['store'])
        $variants = $this->variantRepo->paginaterepo(15);
        //$variants = $this->variantRepo->with(['store'])->paginate(15);
        return response()->json($variants);
    }


    public function form_create()
    {
        return View('variants.form_create');
    }

    public function form_edit()
    {
        return View('variants.form_edit');
    }

    public function create(Request $request)
    {
        $variants = $this->variantRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new VariantManager($variants,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.variant',$variant->all());

        return response()->json(['estado'=>true, 'nombre'=>$variants->nombre]);
    }

    public function find($id)
    {
        $variant = $this->variantRepo->find($id);
        return response()->json($variant);
    }

    public function edit(Request $request)
    {
        $variant = $this->variantRepo->find($request->id);
        //var_dump($variant);
        //die(); 
        $manager = new VariantManager($variant,$request->all());
        $manager->save();

        //Event::fire('update.variant',$variant->all());
        return response()->json(['estado'=>true, 'nombre'=>$variant->nombre]);
    }

    public function destroy(Request $request)
    {
        $variant= $this->variantRepo->find($request->id);
        $variant->delete();
        //Event::fire('update.variant',$variant->all());
        return response()->json(['estado'=>true, 'nombre'=>$variant->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $variants = $this->variantRepo->search($q);

        return response()->json($variants);
    }

    public function select(){
        $variant = $this->variantRepo->all();
        return response()->json($variant);
    }

}