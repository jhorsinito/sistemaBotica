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
      $purchases=Purchase::join('suppliers','purchases.suppliers_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','purchases.warehouses_id')
                       ->select('purchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       ->where('suppliers.empresa','like',$q.'%')
                       ->orWhere('warehouses.nombre','like',$q.'%')
                       ->orWhere('purchases.fechaEntrega','like','%'.$q.'%')
                       ->paginate(15);
        
        return $purchases;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
   public function paginar($c){
    $purchases=Purchase::join('suppliers','purchases.suppliers_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','purchases.warehouses_id')
                       ->select('purchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       ->orderBy('purchases.id','asc')
                       ->paginate($c);
        return $purchases;
   }
    public function select($id){
       $purchases=Purchase::join('suppliers','purchases.suppliers_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','purchases.warehouses_id')
                       ->select('purchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       ->where('purchases.id','=',$id)
                       ->first();
        return $purchases;
    }

    
} 