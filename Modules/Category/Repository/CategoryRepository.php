<?php


namespace Modules\Category\Repository;


use App\DesignPatterns\Repository;
use Modules\Category\Entities\Category;

class CategoryRepository extends Repository
{
    /**
     * @var category
     */
    public $model;

    public function __construct()
    {
        $this->model = new Category();
    }

    public function getCategories (){
        return category::where('parent_id',0)
            ->with('subCategory')
            ->get();
    }

}
