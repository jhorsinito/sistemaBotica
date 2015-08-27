<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Order;

class OrderRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Order;
    }

    public function search($q)
    {
        $orders =Order::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $orders;
    }
    public function paginate($count){
        $orders = Order::leftjoin('salePayments','salePayments.order_id','=','orders.id')
                        ->select('orders.*','salePayments.estado as estadoPago')
                        ->with('customer','employee');
        return $orders->paginate($count);
    }
    public function find($id)
    {
        $order = Order::with('customer','employee');
        return $order->find($id);
    }
} 