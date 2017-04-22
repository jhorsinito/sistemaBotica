<?php
namespace Salesfly\Salesfly\Entities;

class TipoProducto extends \Eloquent {

	protected $table = 'tipoProductos';
    
    protected $fillable = ['nombre','descripcion'];

}