<?php
namespace Salesfly\Salesfly\Entities;

class Curso extends \Eloquent {

	protected $table = 'cursos';
    
    protected $fillable = ['fechaRegistro','descripcion'];
}