<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(15);
        return view('admin.brands.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);
        Brand::create($request->only(['name', 'description', 'logo']));
        return back()->with('success', 'Đã thêm hãng');
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate(['name' => 'required|string|max:100']);
        $brand->update($request->only(['name', 'description', 'logo']));
        return back()->with('success', 'Đã cập nhật');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back()->with('success', 'Đã xóa');
    }
}
