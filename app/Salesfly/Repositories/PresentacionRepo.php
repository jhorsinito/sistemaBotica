<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Presentacion;

class PresentacionRepo extends BaseRepo{
    public function getModel()
    {
        return new Presentacion;
    }
    public function all(){
        return Presentacion::with(['equivFin' => function ($query) {
            $query->join('presentaciones','presentaciones.id','=','equiv.preBase_id')
                    //->select('presentaciones.shortname','equiv.cant')->get();
                    ;
        }])->get();
    }
        public function select($id){
         $presentacioness=Presentacion::leftjoin('equiv','equiv.preBase_id','=','presentaciones.id')
                                   ->where('presentaciones.id','=',$id)
                                   ->select('presentaciones.shortname')->first();
        return $presentacioness;
    }
    public function all_base(){
        return Presentacion::where('base',1)->get();
    }

    public function all_by_base($id){
       /* return Presentacion::with(['equivBase' => function ($query) {
            $query->join('presentaciones','presentaciones.id','=','equiv.preFin_id')
                //->select('shortname','cant');
            ;
        }])->where('presentaciones.id',$id)->get();*/
        return Presentacion::join('equiv','presentaciones.id','=','equiv.preFin_id')
                            ->where('base',0)
                            ->where('equiv.preBase_id',$id)
                            ->get();
    }
}