<?php
namespace Salesfly\Salesfly\Entities;

class HeadInputStock extends \Eloquent {

	protected $table = 'headInputStocks';
    
    protected $fillable = ['fecha','tipo','orderPurchase_id','purchase_id','warehouses_id','warehouses_id','user_id'];

}