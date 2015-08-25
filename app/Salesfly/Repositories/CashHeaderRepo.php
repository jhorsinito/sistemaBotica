<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\CashHeader;



class CashHeaderRepo extends BaseRepo{
    
    public function getModel()
    {       
        return new CashHeader;
    }


    public function search($q)
    {
        $cashHeaders =CashHeader::with('store')->where('nombre','like', $q.'%')
                    ->orWhere('ambiente','like',$q.'%')
                    //->orWhere('s','like',$q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $cashHeaders;
    }


    public function paginate($count){
        $cashHeaders = CashHeader::with('store');
        return $cashHeaders->paginate($count);
    }
} 