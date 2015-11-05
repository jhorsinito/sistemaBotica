<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\HeadInvoice;

class HeadInvoiceRepo extends BaseRepo{
    public function getModel()
    {
        return new HeadInvoice;
    }

    public function consult($id){
    	$headInvoice=HeadInvoice::where("headInvoices.id","=",$id)->first();
    	return $headInvoice;
    }
}