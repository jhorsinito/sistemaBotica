<?php
namespace Salesfly\Salesfly\Managers;
class CashMonthlyManager extends BaseManager {

    public function getRules()
    {
        $rules = ['amount'=> '',
    				'descripcion'=>'',
    				'expenseMonthlys_id'=> 'required',
    				'months_id'=> 'required',
    				'years_id'=> 'required'];
        return $rules;
    }
}