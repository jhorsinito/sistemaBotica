<?php
namespace Salesfly\Salesfly\Entities;

class Stock extends \Eloquent {

    protected $table = 'stock';

    protected $fillable = ['stockActual',
                            'stockMin',
                            'stockMinSoles',
                            'variant_id',
                            'warehouse_id'];

}