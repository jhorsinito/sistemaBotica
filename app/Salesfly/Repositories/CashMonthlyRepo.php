<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\CashMonthly;



class CashMonthlyRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new CashMonthly;
    }

    public function search($q)
    {
        //$cashMonthlys = CashMonthly::with('year','month','expenseMonthly');
        $CashMonthlys =CashMonthly::with('year','month','expenseMonthly')->where('amount','like', $q.'%')
                    ->orWhere('descripcion','like',$q.'%')
                    ->orWhere('months_id','like',$q.'%')
                    ->orWhere('years_id','like',$q.'%')
                    ->orWhere('expenseMonthlys_id','like',$q.'%')
                    //with(['customer','employee'])
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