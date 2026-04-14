<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::with(['brand', 'category'])->where('is_featured', 1)->where('status', 1)->limit(8)->get();
        $newProducts = Product::with(['brand', 'category'])->where('is_new', 1)->where('status', 1)->latest()->limit(8)->get();
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();

        return view('frontend.home', compact('featured', 'newProducts', 'brands', 'categories'));
    }
}
