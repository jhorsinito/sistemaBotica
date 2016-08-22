<?php
namespace Salesfly\Salesfly\Entities;
class Docente extends \Eloquent {
	protected $table = 'docentes';
    
    protected $fillable = ['nombres',
    						'apellidos',
    						'dni',
    						'fechaNac',
                            'fechaRegistro',
							'sexo',
    						'curriculo',
    						'gradoAcademico',
    						'email',
                            'telefono',
    						'nacionalidad',
    						'pais',
    						'estado',
    						'ubigeo_id',
    						'profesion_id'
    						];
    public function ubigeo()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Ubigeo');
    }
}