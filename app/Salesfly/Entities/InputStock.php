<?php
namespace Salesfly\Salesfly\Entities;

class InputStock extends \Eloquent {

	protected $table = 'inputStocks';
    
    protected $fillable = ['cantidad_llegado','descripcion','variant_id','headInputStock_id'];

}