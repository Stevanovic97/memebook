<?php

namespace App;

use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function memes()
    {
        return $this->hasMany('App\Meme');
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getCategory($category_id)
    {
        return Category::where('id', $category_id)->get();
    }

    public function deleteCategory($category_id)
    {
        Category::where('id', $category_id)->delete();
    }

    public function addCategory(CategoryRequest $request)
    {
        Category::create(['name' => $request->name]);
    }

    public function updateCategory(CategoryRequest $request, $category_id)
    {
        $category = Category::find($category_id);
        $category->name = $request->name;
        $category->save();
    }
}
