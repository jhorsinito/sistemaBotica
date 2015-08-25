<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 08/08/15
 * Time: 03:29 PM
 */

namespace Salesfly\Salesfly\Repositories;


use Salesfly\Salesfly\Entities\DetPres;

class DetPresRepo extends BaseRepo{
    public function getModel(){
        return new DetPres;
    }
    public function traerDetalles($id){

        $detPres=DetPres::leftjoin("variants","variants.id","=","detPres.variant_id")
            ->leftjoin("presentation","presentation.id","=","detPres.presentation_id")
            ->leftJoin("equiv","equiv.preFin_id","=","presentation.id")
            ->where("detPres.variant_id","=",$id)
            ->select(\DB::raw("detPres.id as iddetalleP,detPres.presentation_id as presenTid,
                            detPres.price as precioVenta,presentation.*,equiv.cant as equivalencia,
                            equiv.preBase_id as basevalor,(select (presentation.shortname) from presentation where presentation.id=basevalor) 
                            as nomBase"))->paginate();
                    
         return  $detPres;
    }
} 