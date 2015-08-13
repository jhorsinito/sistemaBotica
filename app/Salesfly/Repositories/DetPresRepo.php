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
         $detPres=DetPres::join("variants","variants.id","=","detPres.variant_id")
                           ->join("presentation","presentation.id","=","detPres.presentation_id")
                           ->where("detPres.variant_id","=",$id)->select("detPres.id as iddetalleP",
                           	"detPres.suppPri as precioCompra","presentation.*")->paginate();
          return  $detPres;
    }
     public function traerCodPresentation($id){
     	  $detPres=DetPres::join("presentation","presentation.id","=","detPres.presentation_id")
     	                    ->select("presentation.id as idPresentacion","presentation.base as Presenbase","detPres.variant_id as idVariante")
     	                    ->where("presentation_id","=",$id)->first();
         // $detPres=DetPres::select("presentation_id")->where("presentation_id","=",$id)->first();
          return  $detPres;
    }
} 