<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Marca;

class MarcaRepo extends BaseRepo{
    public function getModel()
    {
        return new Marca;
    }

    public function search($q)
    {
        $marca =Marca::where('nombre','like', $q.'%')
                    ->orWhere('shortname','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $marca;
    }
    public function validarNoRepit($text){
        $marca =Marca::where('nombre','=', $text)
                    ->orWhere('shortname','=', $text)
                    //->with(['customer','employee'])
                    ->first();
        return $marca;
    }
}