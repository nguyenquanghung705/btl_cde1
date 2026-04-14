<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductQuery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /** @var ProductQuery */
    protected $productQuery;

    public function __construct(ProductQuery $productQuery)
    {
        $this->productQuery = $productQuery;
    }

    public function index(Request $request): View
    {
        $products = $this->productQuery->fromRequest($request)
            ->paginate(12)
            ->withQueryString();

        return view('frontend.products.index', [
            'products' => $products,
            'brands' => Brand::active()->get(),
            'categories' => Category::active()->get(),
        ]);
    }

    public function show(Product $product): View
    {
        abort_if(!$product->status, 404);

        $product->increment('views');

        $related = Product::active()
            ->inCategory($product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        $product->load(['brand', 'category']);

        return view('frontend.products.show', compact('product', 'related'));
    }
}
