<?php
namespace Salesfly\Salesfly\Entities;

class Ubigeo extends \Eloquent {

	protected $table = 'ubigeos';
    
    protected $fillable = ['codigo','distrito','provincia','departamento'];

}