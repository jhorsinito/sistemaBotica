<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Edicion;

class EdicionRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Edicion;
    }

    public function search($q)
    {
        $ediciones =Edicion::where('nombre','like', $q.'%')
                    ->paginate(15);
        return $ediciones;
    }
    public function paginaterepo($c){
        $ediciones = Edicion::with('curso')->paginate($c);
        $ediciones = Edicion::with(array('curso'=>function($query){
            $query->select('id','descripcion');
        }))->paginate($c);
        return $ediciones;
    }
} 