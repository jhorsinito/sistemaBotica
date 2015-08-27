<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\SalePayment;

class SalePaymentRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new SalePayment;
    }

    public function search($q)
    {
        $salePayment =SalePayment::where('tipo','=', $q)
                    //with(['customer','employee'])
                    ->paginate(15);
        return $salePayment;
    }

    public function searchPayment($id)
    {
        $salePayment =SalePayment::with('customer')
                        ->where('order_id','=', $id.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $salePayment;
    }
    public function paginate($count){
        $orders = Order::with('customer');
        return $orders->paginate($count);
    }

} 