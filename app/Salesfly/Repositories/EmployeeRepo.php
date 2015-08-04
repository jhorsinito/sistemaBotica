<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Employee;

class EmployeeRepo extends BaseRepo{
    public function getModel()
    {
        return new Employee;
    }

    public function search($q)
    {
        $customers =Employee::where('nombres','like', $q.'%')
                    ->orWhere('apellidos','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $customers;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
} 