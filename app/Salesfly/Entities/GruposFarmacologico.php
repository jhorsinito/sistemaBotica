<?php
namespace Salesfly\Salesfly\Entities;

class GruposFarmacologico extends \Eloquent {

	protected $table = 'gruposFarmacologicos';
    
    protected $fillable = ['nombre','descripcion'];

}