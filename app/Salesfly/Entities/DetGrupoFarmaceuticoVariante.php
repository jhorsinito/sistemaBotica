<?php
namespace Salesfly\Salesfly\Entities;

class DetGrupoFarmaceuticoVariante extends \Eloquent {

	protected $table = 'detGrupoFarmaceuticoVariante';
    
    protected $fillable = ['grupoFarmacologico_id','variant_id'];

}