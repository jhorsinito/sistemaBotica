<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetOrder;

class DetOrderRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new DetOrder;
    }

    public function search($q)
    {
        $detOrders =DetOrder::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $detOrders;
    }
    public function searchDetalle($id)
    {
        //$detOrders = \DB::table('detOrders')->leftjoin('detPres','detOrders.detPre_id','=','detPres.id')
        $detOrders =\DB::table('detOrders')->leftjoin("detPres","detPres.id","=","detOrders.detPre_id")
                    ->leftjoin("variants","variants.id","=","detPres.variant_id")
                    ->leftjoin("products","products.id","=","variants.product_id")
                    ->leftjoin("presentation","presentation.id","=","detPres.presentation_id")
                    ->leftjoin("equiv","equiv.preFin_id","=","presentation.id")
                    
                    ->select(\DB::raw('detOrders.*, products.nombre as nameProducto, presentation.nombre as presentacion ,variants.id as vari , (SELECT GROUP_CONCAT(atributes.nombre SEPARATOR "-") FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=vari
                                GROUP BY variants.id) as NombreAtributos'))

                    ->where('order_id','=', $id.'%')
                             
                    //with(['customer','employee'])
                    ->paginate(15);
        return $detOrders;
    }
} 