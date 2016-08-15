<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Ubigeo;

class UbigeoRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Ubigeo;
    }

    public function search($q)
    {
        $categories =Ubigeo::where('distrito','like', $q.'%')
                    ->orwhere('provincia','like', $q.'%')
                    ->orwhere('departamento','like', $q.'%')
                    ->orwhere('codigo','like', $q.'%')
                    ->paginate(15);
        return $categories;
    }
    public function validarNoRepitCodigo($text){
        $products =Ubigeo::where('codigo','=', $text)
                    ->first();
        return $products;
    }
} 