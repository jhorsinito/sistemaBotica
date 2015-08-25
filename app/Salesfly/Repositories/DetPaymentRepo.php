<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetPayment;

class DetPaymentRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new DetPayment;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    function mostrarDetPayment($id){
        $detPayment=DetPayment::join("methodPayments","methodPayments.id","=","detPayments.methodPayment_id")->select("detPayments.*","methodPayments.nombre as nameMethod")->where('detPayments.payment_id','=',$id)->paginate(8);
        return $detPayment;
    }
} 