<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\ClienteRepo;
use Salesfly\Salesfly\Managers\ClienteManager;

class ClientesController extends Controller {

    protected $clienteRepo;

    public function __construct(ClienteRepo $clienteRepo)
    {
        $this->clienteRepo = $clienteRepo;
    }

    public function index()
    {
        return View('clientes.index');
    }

    public function all()
    {
        $clientes = $this->clienteRepo->paginate(15);
        return response()->json($clientes);
        //var_dump($clientes);
    }

    public function paginatep(){
        $clientes = $this->clienteRepo->paginate(15);
        return response()->json($clientes);
    }


    public function form_create()
    {
        return View('clientes.form_create');
    }

    public function form_edit()
    {
        return View('clientes.form_edit');
    }

    public function create(Request $request)
    {
        $clientes = $this->clienteRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new ClienteManager($clientes,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.brand',$brand->all());

        return response()->json(['estado'=>true, 'nombreCliente'=>$clientes->nombreCliente]);
    }

    public function find($id)
    {
        $cliente = $this->clienteRepo->find($id);
        return response()->json($cliente);
    }

    public function edit(Request $request)
    {
        $cliente = $this->clienteRepo->find($request->id);
        //var_dump($brand);
        //die(); 
        $manager = new ClienteManager($cliente,$request->all());
        $manager->save();

        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true, 'nombreCliente'=>$cliente->nombreCliente]);
    }

    public function destroy(Request $request)
    {
        $cliente= $this->clienteRepo->find($request->id);
        $cliente->delete();
        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true, 'nombreCliente'=>$cliente->nombreCliente]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $clientes = $this->clienteRepo->search($q);

        return response()->json($clientes);
    }
    public function validaClientename($text){
        
        $clientes = $this->clienteRepo->validarNoRepit($text);

        return response()->json($clientes);
    }
}