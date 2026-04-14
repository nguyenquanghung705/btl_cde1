@extends('layouts.frontend')
@section('title', 'Sản phẩm')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="card-header"><strong>Bộ lọc</strong></div>
            <div class="card-body">
                <form method="GET">
                    <input type="hidden" name="keyword" value="{{ request('keyword') }}">

                    <label>Hãng</label>
                    <select name="brand" class="form-select mb-3">
                        <option value="">Tất cả</option>
                        @foreach($brands as $b)
                            <option value="{{ $b->id }}" {{ request('brand') == $b->id ? 'selected' : '' }}>
                                {{ $b->name }}
                            </option>
                        @endforeach
                    </select>

                    <label>Danh mục</label>
                    <select name="category" class="form-select mb-3">
                        <option value="">Tất cả</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" {{ request('category') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>

                    <label>Giá từ</label>
                    <input type="number" name="min_price" class="form-control mb-2" value="{{ request('min_price') }}" placeholder="VNĐ">

                    <label>Giá đến</label>
                    <input type="number" name="max_price" class="form-control mb-3" value="{{ request('max_price') }}" placeholder="VNĐ">

                    <label>Sắp xếp</label>
                    <select name="sort" class="form-select mb-3">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá thấp -> cao</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá cao -> thấp</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Tên A-Z</option>
                    </select>

                    <button class="btn btn-primary w-100">Áp dụng</button>
                    <a href="{{ route('products.index') }}" class="btn btn-link w-100 mt-2">Xóa bộ lọc</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <h4 class="mb-3">
            Sản phẩm
            @if(request('keyword'))
                - Tìm kiếm: "{{ request('keyword') }}"
            @endif
            <small class="text-muted">({{ $products->total() }} sản phẩm)</small>
        </h4>

        @if($products->count() == 0)
            <div class="alert alert-warning">Không có sản phẩm nào phù hợp.</div>
        @else
            <div class="row">
                @foreach($products as $product)
                    @include('frontend.partials.product_card', ['product' => $product])
                @endforeach
            </div>
            {{ $products->links() }}
        @endif
    </div>
</div>
@endsection
