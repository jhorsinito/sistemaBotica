<?php
namespace Salesfly\Salesfly\Entities;

class Presentation extends \Eloquent {

    protected $table = 'presentation';

    protected $fillable = ['nombre','shortname','descripcion'];

    public function equivFin(){
        return $this->hasMany('Salesfly\Salesfly\Entities\Equiv','preFin_id');
    }
    public function equivBase(){
        return $this->hasMany('Salesfly\Salesfly\Entities\Equiv','preBase_id');
    }
}