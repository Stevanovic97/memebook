<?php
namespace App\Repository\Repositories;

use App\Repository\IRepositories\CategoryIRepository;
use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryRepository implements CategoryIRepository
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    function getCategories()
    {
        return $this->model->getAllCategories();
    }

    function getCategory($category_id)
    {
        return $this->model->getCategory($category_id);
    }

    function deleteCategory($category_id)
    {
        $this->model->deleteCategory($category_id);
    }

    function addCategory(CategoryRequest $request)
    {
        $this->model->addCategory($request);
    }

    function updateCategory(CategoryRequest $request, $category_id)
    {
        $this->model->updateCategory($request, $category_id);
    }
}