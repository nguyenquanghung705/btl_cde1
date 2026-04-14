<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(): View
    {
        $brands = Brand::withCount('products')->latest()->paginate(15);

        return view('admin.brands.index', compact('brands'));
    }

    public function store(BrandRequest $request): RedirectResponse
    {
        Brand::create($request->validated());

        return back()->with('success', 'Đã thêm hãng.');
    }

    public function update(BrandRequest $request, Brand $brand): RedirectResponse
    {
        $brand->update($request->validated());

        return back()->with('success', 'Đã cập nhật hãng.');
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();

        return back()->with('success', 'Đã xóa hãng.');
    }
}
