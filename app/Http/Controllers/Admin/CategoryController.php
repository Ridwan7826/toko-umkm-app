<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->categoryService->createCategory($request->only('name'));

        return redirect()->route('admin.categories.index')->with('success', 'Berhasil!');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->categoryService->updateCategory($category, $request->only('name'));

        return redirect()->route('admin.categories.index')->with('success', 'Berhasil!');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);
        return redirect()->route('admin.categories.index')->with('success', 'Berhasil!');
    }
}
