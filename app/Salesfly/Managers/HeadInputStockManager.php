<?php
namespace Salesfly\Salesfly\Managers;
class HeadInputStockManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'fecha'=>'','tipo'=>'','orderPurchase_id'=>'','purchase_id'=>'','warehouses_id'=>''
                  ];
        return $rules;
    }}