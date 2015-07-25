<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Station;

class StationRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Station;
    }

    public function search($q)
    {
        $stations =Station::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $stations;
    }
} 