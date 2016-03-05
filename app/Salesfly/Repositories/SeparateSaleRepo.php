<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\SeparateSale;

class SeparateSaleRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new SeparateSale;
    }
    public function search($q)
    {
        $separate = SeparateSale::leftjoin('salePayments','salePayments.separateSale_id','=','separateSales.id')
            ->leftjoin('customers','separateSales.customer_id','=','customers.id')
            ->select('separateSales.*','salePayments.estado as estadoPago')
            ->with('customer','employee')
            ->where('separateSales.fechaPedido','like', $q.'%')
            ->orWhere('customers.nombres','like',$q.'%')
            ->orWhere('customers.apellidos','like',$q.'%')
            ->orWhere('customers.empresa','like',$q.'%')
            ->orderBy('separateSales.id','DESC')
            ->paginate(15);
        return $separate;
    }
    public function paginate($count){
        $separate = SeparateSale::leftjoin('salePayments','salePayments.separateSale_id','=','separateSales.id')
                        ->select('separateSales.*','salePayments.estado as estadoPago')
                        ->with('customer','employee')
                        ->orderBy('separateSales.id','DESC');
        return $separate->paginate($count);
    }
    public function find($id)
    {
        $separate = SeparateSale::with('customer','employee');
        return $separate->find($id);
    }
    
} 