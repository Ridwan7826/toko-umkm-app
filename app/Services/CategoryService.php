<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::latest()->get();
    }

    public function createCategory(array $data)
    {
        return Category::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);
    }

    public function updateCategory(Category $category, array $data)
    {
        return $category->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);
    }

    public function deleteCategory(Category $category)
    {
        return $category->delete();
    }
}
