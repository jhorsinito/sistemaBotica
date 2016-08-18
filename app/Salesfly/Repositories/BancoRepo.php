<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Banco;

class BancoRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Banco;
    }

    public function search($q)
    {
        $bancos =Banco::where('descripcion','like', $q.'%')
                    ->paginate(15);
        return $bancos;
    }
} 