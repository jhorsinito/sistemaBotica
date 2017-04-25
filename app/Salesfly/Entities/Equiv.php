<?php


namespace Salesfly\Salesfly\Entities;


use Illuminate\Database\Eloquent\Model;

class Equiv extends Model{

    protected $table = 'equiv';

    protected $fillable = ['preBase_id','preFin_id','cant'];
} 