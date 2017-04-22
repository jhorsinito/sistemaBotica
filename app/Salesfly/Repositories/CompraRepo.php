<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Compra;
use Salesfly\Salesfly\Entities\Proveedor;


class CompraRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Compra;
    }

    public function search($q)
    {
        $compras =Compra::where('id','like', $q.'%')
                    ->paginate(15);
        return $compras;
    }
    public function allCompras()
    {
        $compras =Compra::get();
        return $compras;
    }

    public function paginate($qantity){

      $compras = Compra::leftjoin('proveedores','compras.proveedor_id','=','proveedores.id')
            ->leftjoin('users','users.id','=','compras.user_id')
            ->leftjoin('metodoPagos','compras.metodoPago_id','=','metodoPagos.id')
            ->leftjoin('comprobantes','compras.comprobante_id','=','comprobantes.id')
        
            
            
            ->select(\DB::raw('DISTINCT(compras.id) as CompId'),
                'proveedores.nombreProveedor as Proveedor',
                'users.name as Usuario',
                'metodoPagos.nombre as metodoPago',
                'comprobantes.nombreComprobante as Comprobante',
                'compras.created_at as Fecha',
                'compras.observaciones as Observaciones',
                'compras.estado as Estado')
                            //->having()
                            ->groupBy('compras.id')
                            ->paginate($qantity);
        return $compras;
    }

     
}