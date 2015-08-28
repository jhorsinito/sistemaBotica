<?php
namespace Salesfly\Salesfly\Entities;

class Variant extends \Eloquent {

    protected $table = 'variants';

    protected $fillable = ['sku',
                            'suppPri',
                            'markup',
                            'price',
                            'track',
                            'favorito',
                            'product_id'];

    public function atributes(){
        return $this->belongsToMany('Salesfly\Salesfly\Entities\Atribut','detAtr','variant_id','atribute_id');
    }

    public function detAtr(){
        return $this->hasMany('\Salesfly\Salesfly\Entities\DetAtr');
    }

    public function product(){
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Product');
    }
     public function detPre(){
        return $this->hasMany('\Salesfly\Salesfly\Entities\DetPres');
    }
}