<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\OrderPurchase;

class OrderPurchaseRepo extends BaseRepo{
    public function getModel()
    {
        return new OrderPurchase;
    }

    public function search($q)
    {
        $orderOrderPurchases =Employee::where('nombres','like', $q.'%')
                    ->orWhere('apellidos','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $orderOrderPurchases;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    public function paginar($c){
    $purchases=OrderPurchase::join('suppliers','orderPurchases.suppliers_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','orderPurchases.warehouses_id')
                       ->select('orderPurchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')->orderBy('orderPurchases.id','asc')
                       ->paginate($c);
        return $purchases;
   }
   public function searchEstados($estado){
    $purchases=OrderPurchase::join('suppliers','orderPurchases.suppliers_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','orderPurchases.warehouses_id')
                       ->select('orderPurchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')->where('orderPurchases.Estado','=',$estado)
                       ->orderBy('orderPurchases.id','asc')
                       ->paginate(25);
        return $purchases;
   }
    public function traerSumplier($id){
        $orderPurchases=OrderPurchase::join('suppliers','orderPurchases.suppliers_id','=','suppliers.id')
        ->where('suppliers.id','=',$id)->select('suppliers.empresa as empresa')->first();
        return $orderPurchases;
    }

    
} 