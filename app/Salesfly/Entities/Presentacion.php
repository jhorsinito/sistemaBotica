<?php
namespace Salesfly\Salesfly\Entities;

class Presentacion extends \Eloquent {

    protected $table = 'presentaciones';

    protected $fillable = ['nombre','shortname','descripcion'];
	    public function equivFin(){
        return $this->hasMany('Salesfly\Salesfly\Entities\Equiv','preFin_id');
    }
    public function equivBase(){
        return $this->hasMany('Salesfly\Salesfly\Entities\Equiv','preBase_id');
    }
     public function detPre(){
        return $this->hasMany('Salesfly\Salesfly\Entities\DetPres');
    }
    public function equiv(){
        return $this->hasMany('Salesfly\Salesfly\Entities\Equiv');
    }
}