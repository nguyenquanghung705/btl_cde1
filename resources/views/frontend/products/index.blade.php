@extends('layouts.frontend')
@section('title', 'Sản phẩm - Laptop Shop')

@push('scripts')
<style>
    .filter-card {
        background: #fff;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,.04);
    }
    .filter-card label { font-weight: 600; font-size: .9rem; color: #555; margin-top: 10px; }
    .filter-card .form-select, .filter-card .form-control { border-radius: 8px; }
    .filter-title {
        font-weight: 800; font-size: 1.1rem; color: #2c3e50;
        padding-bottom: 10px; border-bottom: 2px solid #eef1f7; margin-bottom: 4px;
    }
    .result-bar {
        background: #fff; border-radius: 10px; padding: 12px 18px;
        margin-bottom: 18px; display: flex; align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,.04);
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-3 mb-3">
        <div class="filter-card">
            <div class="filter-title"><i class="bi bi-funnel-fill text-primary"></i> Bộ lọc</div>
            <form method="GET">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">

                <label>Hãng sản xuất</label>
                <select name="brand" class="form-select">
                    <option value="">Tất cả hãng</option>
                    @foreach($brands as $b)
                        <option value="{{ $b->id }}" {{ request('brand') == $b->id ? 'selected' : '' }}>
                            {{ $b->name }}
                        </option>
                    @endforeach
                </select>

                <label>Danh mục</label>
                <select name="category" class="form-select">
                    <option value="">Tất cả danh mục</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ request('category') == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>

                <label>Giá từ (VNĐ)</label>
                <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}" placeholder="VD: 10000000">

                <label>Giá đến (VNĐ)</label>
                <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="VD: 30000000">

                <label>Sắp xếp</label>
                <select name="sort" class="form-select">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Tên A-Z</option>
                </select>

                <button class="btn btn-primary w-100 mt-3"><i class="bi bi-check-circle"></i> Áp dụng</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                    <i class="bi bi-x-circle"></i> Xóa bộ lọc
                </a>
            </form>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="result-bar">
            <div>
                <strong style="font-size:1.1rem">
                    @if(request('keyword'))
                        Kết quả tìm: "{{ request('keyword') }}"
                    @else
                        Tất cả sản phẩm
                    @endif
                </strong>
                <span class="text-muted ms-2">{{ $products->total() }} sản phẩm</span>
            </div>
        </div>

        @if($products->count() == 0)
            <div class="alert alert-warning text-center py-5">
                <i class="bi bi-exclamation-triangle" style="font-size:2rem"></i>
                <h5 class="mt-2">Không tìm thấy sản phẩm phù hợp</h5>
                <p class="mb-0">Hãy thử bộ lọc khác hoặc xóa bộ lọc.</p>
            </div>
        @else
            <div class="row">
                @foreach($products as $product)
                    @include('frontend.partials.product_card', ['product' => $product])
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
