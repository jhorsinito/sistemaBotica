<?php
namespace Salesfly\Salesfly\Entities;

class Category extends \Eloquent {

	protected $table = 'categories';
    
    protected $fillable = ['nombre','shortname','descripcion'];

}