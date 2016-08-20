<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Profesion;

class ProfesionRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Profesion;
    }

    public function search($q)
    {
        $profesiones =Profesion::where('nombre','like', $q.'%')
                    ->paginate(15);
        return $profesiones;
    }
    public function paginaterepo($c){
        $profesiones = Profesion::orderBy('orden', 'asc')
                    ->paginate($c);
        return $profesiones;
    }
    public function CargarProfeciones(){
        $profesiones = Profesion::orderBy('orden', 'asc')
                    ->get();
        return $profesiones;
    }
} 