<?php
namespace Salesfly\Salesfly\Entities;

class Stock extends \Eloquent {

    protected $table = 'stock';

    protected $fillable = ['stockActual',
                            'stockMin',
                            'stockMinSoles',
                            'product_id',
                            'variant_id'];

}