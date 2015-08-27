<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Cash;

class CashRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Cash;
    }
/*
    public function search($q)
    {
        $materials =Cash::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $materials;
    }
*/
} 