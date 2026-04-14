<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);
        Category::create($request->only(['name', 'description']));
        return back()->with('success', 'Đã thêm danh mục');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:100']);
        $category->update($request->only(['name', 'description']));
        return back()->with('success', 'Đã cập nhật');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Đã xóa');
    }
}
