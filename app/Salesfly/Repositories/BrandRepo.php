<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Brand;

class BrandRepo extends BaseRepo{
    public function getModel()
    {
        return new Brand;
    }

    public function search($q)
    {
        $brands =Brand::where('nombre','like', $q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $brands;
    }
}