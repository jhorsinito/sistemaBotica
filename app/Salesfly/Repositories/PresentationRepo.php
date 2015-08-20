<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Presentation;

class PresentationRepo extends BaseRepo{
    public function getModel()
    {
        return new Presentation;
    }
    public function select($id){
         $presentations=Presentation::leftjoin('equiv','equiv.preBase_id','=','presentation.id')
                                   ->where('presentation.id','=',$id)
                                   ->select('presentation.shortname')->first();
        return $presentations;
    }

}