<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\CashMonthly;


class CashMonthlyRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new CashMonthly;
    }

    public function search($m,$a,$c)
    { 
        if($m==0){
            $m='%%';
        }
        if($a==0){
            $a='%%';
        }
        if($c==0){
            $c='%%';
        }
            $CashMonthlys =CashMonthly::with('year','month','expenseMonthly')
                    ->where('months_id','like',$m)
                    ->where('years_id','like',$a) 
                    ->where('expenseMonthlys_id','like',$c)  
                    ->paginate(15); 


        return $CashMonthlys;
    }

    //public function store()
    //{
     //   return $this->belongsTo('\Salesfly\Salesfly\Entities\Month');
    //}

    public function paginate($count){
        $cashMonthlys = CashMonthly::with('year','month','expenseMonthly');
        return $cashMonthlys->paginate($count);
    }
} 