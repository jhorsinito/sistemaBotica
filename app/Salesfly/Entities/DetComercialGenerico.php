<?php
namespace Salesfly\Salesfly\Entities;

class DetComercialGenerico extends \Eloquent {

	protected $table = 'detComercialGenerico';
    
    protected $fillable = ['productoComercial_id','productoGenerico_id'];

}