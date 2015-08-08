<?php
namespace Salesfly\Salesfly\Entities;

class Presentation extends \Eloquent {

    protected $table = 'presentation';

    protected $fillable = ['nombre','shortname','descripcion'];

}