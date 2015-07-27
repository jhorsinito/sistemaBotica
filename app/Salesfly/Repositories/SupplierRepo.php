<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Supplier;

class SupplierRepo extends BaseRepo{
    public function getModel()
    {
        return new Supplier;
    }

    public function search($q)
    {
        $supplier =Supplier::where('nombres','like', $q.'%')
                    ->orWhere('apellidos','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $supplier;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
} 