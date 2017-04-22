<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\TipoDocumento;
class TipoDocumentoRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new TipoDocumento;
    }
    public function search($q)
    {
        $tipoDocumento =TipoDocumento::where('nombreDocumento','like', $q.'%')
                    ->orwhere('descripcion','like', $q.'%')
                    ->paginate(15);
        return $tipoDocumento;
    }
    public function allTipoDocumentos()
    {
        $tipoDocumento =TipoDocumento::orderBy('nombreDocumento', 'asc')
                        ->get();
        return $tipoDocumento;
    }
     
} 