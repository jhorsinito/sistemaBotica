<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Cliente;
class ClienteRepo extends BaseRepo{

    public function getModel()
    {
        return new Cliente;
    }
    public function search($q)
    {
        $clientes =Cliente::where('nombreCliente','like', $q.'%')
                    ->orwhere('email','like', $q.'%')
                    ->paginate(15);
        return $clientes;
    }
    
   public function allClientes()
    {
        $clientes =Cliente::orderBy('nombreCliente', 'asc')
                        ->get();
        return $clientes;
    }
    
    
}