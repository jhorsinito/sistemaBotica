<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetCash;

class DetCashRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new DetCash;
    }

    public function search($q)
    {
        $detCashs =DetCash::join('cashMotives','cashMotives.id','=','detCash.cashMotive_id')
                    ->join('cashes','cashes.id','=','detCash.cash_id')
                    ->join('users','users.id','=','cashes.user_id')
                    ->join('cashHeaders','cashHeaders.id','=','cashes.cashHeader_id')
                    ->join('sales','sales.cash_id','=','cashes.id')
                    ->leftjoin('headInvoices as hi','hi.venta_id','=','sales.id')
                           ->select(\DB::raw("detCash.*,cashMotives.nombre as nommovimiento, users.name,
                            cashHeaders.nombre,hi.tipoDoc,
                            IF(hi.numero<10,CONCAT('000000',hi.numero),
                             IF(hi.numero<100,CONCAT('00000',hi.numero),
                             IF(hi.numero<1000,CONCAT('0000',hi.numero),
                             IF(hi.numero<10000,CONCAT('000',hi.numero),
                             IF(hi.numero<100000,CONCAT('00',hi.numero),
                             IF(hi.numero<100000,CONCAT('0',hi.numero),hi.numero
                             ))))))as NumDocument"))
                    ->where('detCash.cash_id','=', $q)
                    ->groupBy('sales.id')
                    ->paginate(15);
        return $detCashs;
    }
    public function searchSale($q)
    {
        $detCashs =DetCash::join('cashMotives','cashMotives.id','=','detCash.cashMotive_id')
                    ->join('cashes','cashes.id','=','detCash.cash_id')
                    ->join('users','users.id','=','cashes.user_id')
                    ->join('sales','sales.cash_id','=','cashes.id')
                    ->join('cashHeaders','cashHeaders.id','=','cashes.cashHeader_id')
                    ->leftjoin('headInvoices as hi','hi.venta_id','=','sales.id')
                           ->select(\DB::raw("detCash.*,cashMotives.nombre as nommovimiento, users.name,
                            cashHeaders.nombre,hi.tipoDoc,hi.id as idDocu,
                            IF(hi.numero<10,CONCAT('000000',hi.numero),
                             IF(hi.numero<100,CONCAT('00000',hi.numero),
                             IF(hi.numero<1000,CONCAT('0000',hi.numero),
                             IF(hi.numero<10000,CONCAT('000',hi.numero),
                             IF(hi.numero<100000,CONCAT('00',hi.numero),
                             IF(hi.numero<100000,CONCAT('0',hi.numero),hi.numero
                             ))))))as NumDocument"))
                        ->where('detCash.cash_id','=', $q)
                        ->where('detCash.cashMotive_id','=','1')
                        ->orWhere('detCash.cash_id','=', $q)
                        ->where('detCash.cashMotive_id','=','14')
                        ->groupBy('sales.id')
                        //->orWhere('cashMotive_id','=','14')
                    ->paginate(15);
        return $detCashs; 
    } 
    public function searchOrderSale($q)
    {
        $detCashs =DetCash::with('cashMotive')
                        ->where('cash_id','=', $q)
                        ->where('cashMotive_id','=','15')
                        ->orWhere('cash_id','=', $q)
                        ->where('cashMotive_id','=','16')
                        //->orWhere('cashMotive_id','=','14')
                    ->paginate(15);
        return $detCashs;
    }
    public function searchSeparateSale($q)
    {
        $detCashs =DetCash::with('cashMotive')
                        ->where('cash_id','=', $q)
                        ->where('cashMotive_id','=','19')
                        ->orWhere('cash_id','=', $q)
                        ->where('cashMotive_id','=','20')
                        //->orWhere('cashMotive_id','=','14')
                    ->paginate(15);
        return $detCashs;
    }
     
    public function paginate($count){
        $detCashs = DetCash::with('cashMotive');
        return $detCashs->paginate($count);
    } 
   public function compCajaActiva($id){
        $detCashs = DetCash::join('cashes','cashes.id','=','detCash.cash_id')
                          ->where('detCash.id','=',$id)
                          ->select('cashes.estado')
        ->first();
        return $detCashs;
    }


}