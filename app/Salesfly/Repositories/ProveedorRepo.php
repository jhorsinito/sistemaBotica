<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Proveedor;
class ProveedorRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Proveedor;
    }
    public function search($q)
    { 
        $proveedor =Proveedor::where('nombreProveedor','like', $q.'%')
                    ->orwhere('numCuenta','like', $q.'%')
                    ->orwhere('numDocumento','like', $q.'%')
                    ->orwhere('email','like', $q.'%')
                    ->orwhere('webSite','like', $q.'%')
                    ->paginate(15);
        return $proveedor;
    }
     
    public function allProveedores()
    {
        $proveedor =Proveedor::orderBy('nombreProveedor', 'asc')
                        ->get();
        return $proveedor;
    }
     public function paginaterepo($c){
        $proveedor = Proveedor::with('tipoDocumento')->paginate($c);
        $proveedor = Proveedor::with(array('tipoDocumento'=>function($query){
            $query->select('id','nombreDocumento');
        }))->paginate($c);
        return $proveedor;
    }
}