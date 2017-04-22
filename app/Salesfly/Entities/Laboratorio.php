<?php
namespace Salesfly\Salesfly\Entities;

class Laboratorio extends \Eloquent {

	protected $table = 'laboratorios';
    
    protected $fillable = ['nombre','shortName','descripcion'];

}