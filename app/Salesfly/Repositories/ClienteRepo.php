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
        $cliente =Cliente::where('nombreCliente','like', $q.'%')
                    ->orwhere('direccion','like', $q.'%')
                    ->paginate(15);
        return $cliente;
    }
    
   
}
