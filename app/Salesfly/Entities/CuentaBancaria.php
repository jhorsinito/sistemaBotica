<?php
namespace Salesfly\Salesfly\Entities;

class CuentaBancaria extends \Eloquent {

	protected $table = 'cuentaBancarias';
    
    protected $fillable = ['numeroCuenta','banco_id'];

    public function banco()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Banco');
    }
}