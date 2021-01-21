<?php


namespace Modules\Category\Http\Service;


use Modules\Category\Repository\CategoryRepository;
use Modules\Media\Http\Service\MediaService;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;


    public function __construct(
        CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory ($data){
        return $this->categoryRepository->create($data);
    }

    public function getAllCategory (){
        return $this->categoryRepository->getCategories();
    }

    public function deleteCategory ($id){
        return $this->categoryRepository->delete($id);
    }

    public function getCategoryById ($category_id){
        return $this->categoryRepository->getById($category_id);
    }

    public function updateCategory ($data,$id){
        return $this->categoryRepository->update($data,$id);
    }

}
