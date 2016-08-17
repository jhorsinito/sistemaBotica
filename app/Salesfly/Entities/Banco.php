<?php
namespace Salesfly\Salesfly\Entities;

class Banco extends \Eloquent {

	protected $table = 'bancos';
    
    protected $fillable = ['nombre'];

}