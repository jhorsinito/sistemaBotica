<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Atribut;

class AtributRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Atribut;
    }

    public function search($q)
    {
        $atributes =Atribut::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $atributes;
    }
} 