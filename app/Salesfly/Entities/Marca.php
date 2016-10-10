<?php
namespace Salesfly\Salesfly\Entities;

class Marca extends \Eloquent {

	protected $table = 'marcas';
    
    protected $fillable = ['nombre','descripcion'];

}