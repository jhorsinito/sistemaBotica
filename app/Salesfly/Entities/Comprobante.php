<?php
namespace Salesfly\Salesfly\Entities;

class Comprobante extends \Eloquent {

	protected $table = 'comprobantes';
    
    protected $fillable = ['nombreComprobante',
    					   'descripcion'];


    public function compra()
    {
    return $this-> hasmany(Compra::class);
    }

}