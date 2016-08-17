<?php
namespace Salesfly\Salesfly\Entities;

class Profesion extends \Eloquent {

	protected $table = 'profesiones';
    
    protected $fillable = ['nombre','descripcion'];

}