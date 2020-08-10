<?php
namespace App\Repository\IRepositories;

use App\Http\Requests\CategoryRequest;

interface CategoryIRepository
{
    function getCategories();
    function getCategory($category_id);
    function deleteCategory($category_id);
    function addCategory(CategoryRequest $request);
    function updateCategory(CategoryRequest $request, $category_id);
}