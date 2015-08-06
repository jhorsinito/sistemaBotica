<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetailPurchase;

class DetailPurchaseRepo extends BaseRepo{
    public function getModel()
    {
        return new DetailPurchase;
    }

    public function search($q)
    {
        $detailPurchaseRepo =Customer::where('descuento','like', $q.'%')
                    //->orWhere('apellidos','like',$q.'%')
                    //->orWhere('empresa','like',$q.'%')
                    //->orWhere('ruc','like',$q.'%')
                    //->with(['customer','employee'])
                    //->paginate(15);
        return $detailPurchaseRepo;
    }

    //function validateDate($date, $format = 'Y-m-d')
    //{
      //  $d = \DateTime::createFromFormat($format, $date);
        //return $d && $d->format($format) == $date;
    //}
}