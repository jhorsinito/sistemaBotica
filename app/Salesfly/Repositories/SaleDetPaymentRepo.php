<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\SaleDetPayment;

class SaleDetPaymentRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new SaleDetPayment;
    }

    public function search($q)
    {
        $saleDetPayment =SaleDetPayment::where('tipo','=', $q)
                    //with(['customer','employee'])
                    ->paginate(15);
        return $saleDetPayment;
    }
    public function searchDetalle($id)
    {
        $salePayment =SaleDetPayment::with('saleMethodPayment')
                        ->where('salePayment_id','=', $id.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $salePayment;
    }
    public function mostrarDetPayment($id)
    {
        $saleDetPayment =SaleDetPayment::where('salePayment_id','=', $id)
                    //with(['customer','employee'])
                    ->paginate(15);
        return $saleDetPayment;
    }
    

} 