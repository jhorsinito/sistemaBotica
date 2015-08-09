<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 08/08/15
 * Time: 03:29 PM
 */

namespace Salesfly\Salesfly\Repositories;


use Salesfly\Salesfly\Entities\DetPres;

class DetPresRepo extends BaseRepo{
    public function getModel(){
        return new DetPres;
    }
} 