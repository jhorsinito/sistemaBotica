<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetComercialGenerico;

class DetComercialGenericoRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new DetComercialGenerico;
    }
    public function all()
    {
        $detComercialGenerico =DetComercialGenerico::get();
        return $detComercialGenerico;
    }
    public function buscarGenerioco($id)
    {
        $detComercialGenerico =DetComercialGenerico::leftjoin('products','products.id','=','detComercialGenerico.productoComercial_id')
        						->where('productoGenerico_id','=',$id)
        						->select('detComercialGenerico.*','products.nombre as nombre')
        						->get();
        return $detComercialGenerico;
    }
    public function buscarComercial($id)
    {
        $detComercialGenerico =DetComercialGenerico::leftjoin('products','products.id','=','detComercialGenerico.productoGenerico_id')
        						->where('productoComercial_id','=',$id)
        						->select('detComercialGenerico.*','products.nombre as nombre')
        						->get();
        return $detComercialGenerico;
    }

} 