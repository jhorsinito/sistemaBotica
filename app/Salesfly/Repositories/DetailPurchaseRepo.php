<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetailPurchase;

class DetailPurchaseRepo extends BaseRepo{
    public function getModel()
    {
        return new DetailPurchase;
    }


    //function validateDate($date, $format = 'Y-m-d')
    //{
      //  $d = \DateTime::createFromFormat($format, $date);
        //return $d && $d->format($format) == $date;
    //}
    public function paginate($id){
      $detailpurchase=DetailPurchase::join("variants","variants.id","=","detailPurchases.variants_id")
      ->select('detailPurchases.*','variants.sku as codigo')->where("detailPurchases.purchases_id","=",$id)
      ->paginate();
      return $detailpurchase;
    }
    public function Eliminar($id){
     $detailpurchase=DetailPurchase::select("*")->where("detailPurchases.purchases_id","=",$id)
     ->get();
     return $detailpurchase;
    }
}