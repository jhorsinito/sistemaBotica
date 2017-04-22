<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Comprobante;

class ComprobanteRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Comprobante;
    }

    public function search($q)
    {
        $comprobantes =Comprobante::where('nombreComprobante','like', $q.'%')
                    ->paginate(15);
        return $comprobantes;
    }
    public function allComprobantes()
    {
        $comprobantes =Comprobante::get();
        return $comprobantes;
    }
}