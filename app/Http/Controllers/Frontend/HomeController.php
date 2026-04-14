<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featured = Product::with(['brand', 'category'])
            ->active()
            ->featured()
            ->limit(8)
            ->get();

        $newProducts = Product::with(['brand', 'category'])
            ->active()
            ->new()
            ->latest()
            ->limit(8)
            ->get();

        return view('frontend.home', [
            'featured' => $featured,
            'newProducts' => $newProducts,
            'brands' => Brand::active()->get(),
            'categories' => Category::active()->get(),
        ]);
    }
}
