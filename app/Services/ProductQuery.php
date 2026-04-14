<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductQuery
{
    /**
     * Build a filtered, sorted Product query from request parameters.
     */
    public function fromRequest(Request $request): Builder
    {
        $query = Product::query()
            ->with(['brand', 'category'])
            ->active();

        $query
            ->when($request->filled('keyword'), function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('keyword') . '%');
            })
            ->when($request->filled('brand'), function ($q) use ($request) {
                $q->where('brand_id', $request->input('brand'));
            })
            ->when($request->filled('category'), function ($q) use ($request) {
                $q->where('category_id', $request->input('category'));
            })
            ->when($request->filled('min_price'), function ($q) use ($request) {
                $q->where('price', '>=', (int) $request->input('min_price'));
            })
            ->when($request->filled('max_price'), function ($q) use ($request) {
                $q->where('price', '<=', (int) $request->input('max_price'));
            });

        switch ($request->input('sort', 'newest')) {
            case 'price_asc':
                return $query->orderBy('price');
            case 'price_desc':
                return $query->orderByDesc('price');
            case 'name':
                return $query->orderBy('name');
            default:
                return $query->latest();
        }
    }
}
