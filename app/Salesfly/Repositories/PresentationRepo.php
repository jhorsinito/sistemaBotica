<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Presentation;

class PresentationRepo extends BaseRepo{
    public function getModel()
    {
        return new Presentation;
    }

}