<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Category;

class CategoryRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Category;
    }

    public function search($q)
    {
        $categories =Category::where('nombre','like', $q.'%')
                    ->paginate(15);
        return $categories;
    }
} 