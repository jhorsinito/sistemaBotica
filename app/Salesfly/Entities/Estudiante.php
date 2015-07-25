<?php
namespace Salesfly\Salesfly\Entities;

class Estudiante extends \Eloquent {

	protected $table = 'estudiantes';
    
    protected $fillable = ['nombre'];

}