<?php
namespace Salesfly\Salesfly\Repositories;

use Salesfly\Salesfly\Entities\Venta;


class VentaRepo extends BaseRepo{

    public function getModel(){
        return new Venta;
    }
/*
    public function search($q)
    {
       
        $ventas = Venta::leftjoin('tiendas','ventas.tienda_id','=','tiendas.id')
            ->leftjoin('comprobantes','ventas.comprobante_id','=','comprobantes.id')
            ->leftjoin('clientes','ventas.cliente_id','=','clientes.id')
        
            
            ->leftjoin('users','users.id','=','ventas.user_id')
            ->select(\DB::raw('DISTINCT(ventas.id) as proId'),'ventas.codigo as Codigo','ventas.numero as Numero','ventas.nombre as Nombre',
                'users.name as Usuario','ventas.estado as Estado',
                'tiendas.nombreTienda as Tienda','comprobantes.nombreComprobante as Comprobante','ventas.created_at as Creado','clientes.nombreCliente as Cliente')
               


           
            ->groupBy('ventas.id')
            ->where('ventas.nombre','like',$q.'%')
            ->paginate(15);
        return $ventas;
    }
*/
    public function searchVentas($q)
    {
        $ventas = Venta::select('id','nombre')
              
                    ->get();
        return $ventas;
    }
 

    public function paginate($qantity){

      $ventas = Venta::leftjoin('tiendas','ventas.tienda_id','=','tiendas.id')
            ->leftjoin('comprobantes','ventas.comprobante_id','=','comprobantes.id')
            ->leftjoin('clientes','ventas.cliente_id','=','clientes.id')
        
            
            ->leftjoin('users','users.id','=','ventas.user_id')
            ->select(\DB::raw('DISTINCT(ventas.id) as proId'),'ventas.codigo as Codigo','ventas.numero as Numero','ventas.nombre as Nombre',
                'users.name as Usuario','ventas.estado as Estado',
                'tiendas.nombreTienda as Tienda','comprobantes.nombreComprobante as Comprobante','ventas.created_at as Creado','clientes.nombreCliente as Cliente')
               

 
                            //->having()
                            ->groupBy('ventas.id')
                            ->paginate($qantity);
        return $ventas;
    }
    
     
   
    public function find($id){
        $oVenta = Venta::find($id);

        $venta = $oVenta->load(['cliente','comprobante','tienda','product']);

        return $venta;
    }

    
    public function validarCodigo($text){
        $ventas =venta::where('codigo','=', $text)
                    //->with(['customer','employee'])
                    ->first();
        return $ventas;
    }

}
