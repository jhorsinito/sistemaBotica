<?php
namespace Salesfly\Salesfly\Entities;

class Acreditadora extends \Eloquent {

	protected $table = 'acreditadoras';
    
    protected $fillable = ['nombre','ubigeo_id'];

    public function ubigeo()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Ubigeo');
    }
}