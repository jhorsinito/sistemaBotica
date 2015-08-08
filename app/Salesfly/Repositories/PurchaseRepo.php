<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Purchase;

class PurchaseRepo extends BaseRepo{
    public function getModel()
    {
        return new Purchase;
    }

    public function search($q)
    {
        $customers =Employee::where('nombres','like', $q.'%')
                    ->orWhere('apellidos','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $customers;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
   /* public function ultimoDato(){
        $purchases=Purchase::select('id')->orderBy('id','desc')->first();
        return $purchases;
    }*/
    public function traerSumplier($id){
        $purchases=Purchase::join('suppliers','purchases.suppliers_id','=','suppliers.id')
        ->where('suppliers.id','=',$id)->select('suppliers.empresa as empresa')->first();
        return $purchases;
    }
} 