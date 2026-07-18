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
        $imagePath = null;
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $imagePath = $data['image']->store('categories', 'public');
        }

        return Category::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'image' => $imagePath,
        ]);
    }

    public function updateCategory(Category $category, array $data)
    {
        $updateData = [
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ];

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($category->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($category->image);
            }
            $updateData['image'] = $data['image']->store('categories', 'public');
        }

        return $category->update($updateData);
    }

    public function deleteCategory(Category $category)
    {
        if ($category->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($category->image);
        }
        return $category->delete();
    }
}
