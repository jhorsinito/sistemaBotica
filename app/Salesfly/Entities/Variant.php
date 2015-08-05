<?php
namespace Salesfly\Salesfly\Entities;

class Variant extends \Eloquent {

    protected $table = 'variants';

    protected $fillable = ['sku',
                            'suppPri',
                            'markup',
                            'price',
                            'track',
                            'product_id'];

}