<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Store;

class StoreRepo extends BaseRepo{
    
    public function getModel()
    {
        return new Store;
    }

    public function search($q)
    {
        $stores =Store::where('direccion','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $stores;
    }
    public function all(){
        //$stores = $this->storeRepo->all();
        //return response()->json($stores);
        $stores = Store::all();
        return $stores;
    }
} 