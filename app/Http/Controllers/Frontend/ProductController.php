<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'category'])->where('status', 1);

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc': $query->orderBy('price', 'asc'); break;
            case 'price_desc': $query->orderBy('price', 'desc'); break;
            case 'name': $query->orderBy('name', 'asc'); break;
            default: $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();

        return view('frontend.products.index', compact('products', 'brands', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with(['brand', 'category'])->where('slug', $slug)->firstOrFail();
        $product->increment('views');
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->limit(4)->get();
        return view('frontend.products.show', compact('product', 'related'));
    }
}
