@extends('layouts.frontend')
@section('title', $product->name)

@push('scripts')
<style>
    .detail-img-wrap {
        background: linear-gradient(135deg,#f8fafd,#eef2fa);
        border-radius: 16px;
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 420px;
    }
    .detail-img-wrap img { max-width: 100%; max-height: 360px; object-fit: contain; }
    .price-box {
        background: linear-gradient(135deg, #fff5f3, #ffe8e0);
        border-radius: 12px;
        padding: 18px 20px;
        border-left: 4px solid var(--sale);
    }
    .spec-table th {
        background: #f4f6fa;
        width: 170px;
        font-weight: 600;
        color: #555;
    }
    .spec-table td, .spec-table th { padding: 10px 14px; }
    .detail-title { font-weight: 800; font-size: 1.6rem; color: #2c3e50; }
    .meta-line { color: #7f8c8d; font-size: .92rem; }
    .meta-line span { margin-right: 14px; }
    .btn-buy-now {
        background: var(--accent); color: #fff; border: 0;
        border-radius: 10px; padding: 12px; font-weight: 700;
    }
    .btn-buy-now:hover { background: #e85a1f; color: #fff; }
</style>
@endpush

@section('content')
<nav>
    <ol class="breadcrumb bg-white px-3 py-2 rounded">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house"></i> Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
        <li class="breadcrumb-item active">{{ Str::limit($product->name, 50) }}</li>
    </ol>
</nav>

<div class="row bg-white rounded p-4" style="box-shadow: 0 2px 8px rgba(0,0,0,.04);">
    <div class="col-lg-5">
        <div class="detail-img-wrap">
            <img src="{{ $product->image ?: 'https://placehold.co/600x400?text=Laptop' }}"
                 onerror="this.src='https://placehold.co/600x400?text=Laptop'"
                 alt="{{ $product->name }}">
        </div>
    </div>

    <div class="col-lg-7">
        <h1 class="detail-title">{{ $product->name }}</h1>
        <p class="meta-line mt-2">
            <span><i class="bi bi-tag-fill text-primary"></i> {{ $product->brand->name }}</span>
            <span><i class="bi bi-folder-fill text-primary"></i> {{ $product->category->name }}</span>
            <span><i class="bi bi-eye-fill"></i> {{ $product->views }} lượt xem</span>
        </p>

        <div class="price-box my-3">
            <span class="price" style="font-size:1.8rem">{{ number_format($product->display_price) }}₫</span>
            @if($product->sale_price)
                <span class="price-old ms-2">{{ number_format($product->price) }}₫</span>
                <span class="badge bg-danger ms-2">Giảm {{ $product->discount_percent }}%</span>
            @endif
        </div>

        <table class="table spec-table table-bordered mb-3">
            <tbody>
                <tr><th><i class="bi bi-cpu"></i> CPU</th><td>{{ $product->cpu }}</td></tr>
                <tr><th><i class="bi bi-memory"></i> RAM</th><td>{{ $product->ram }}</td></tr>
                <tr><th><i class="bi bi-device-hdd"></i> Ổ cứng</th><td>{{ $product->storage }}</td></tr>
                <tr><th><i class="bi bi-gpu-card"></i> Card đồ họa</th><td>{{ $product->gpu }}</td></tr>
                <tr><th><i class="bi bi-display"></i> Màn hình</th><td>{{ $product->screen }}</td></tr>
                <tr><th><i class="bi bi-windows"></i> Hệ điều hành</th><td>{{ $product->os }}</td></tr>
                <tr><th><i class="bi bi-feather"></i> Cân nặng</th><td>{{ $product->weight }} kg</td></tr>
                <tr><th><i class="bi bi-battery-full"></i> Pin</th><td>{{ $product->battery }}</td></tr>
                <tr><th><i class="bi bi-shield-check"></i> Bảo hành</th><td>{{ $product->warranty }}</td></tr>
                <tr><th><i class="bi bi-box-seam"></i> Tồn kho</th><td>
                    @if($product->stock > 0)
                        <span class="text-success"><i class="bi bi-check-circle-fill"></i> Còn {{ $product->stock }} sản phẩm</span>
                    @else
                        <span class="text-danger"><i class="bi bi-x-circle-fill"></i> Hết hàng</span>
                    @endif
                </td></tr>
            </tbody>
        </table>

        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="row g-2 align-items-end">
            @csrf
            <div class="col-3">
                <label class="form-label small fw-bold">Số lượng</label>
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control">
            </div>
            <div class="col-9">
                <button type="submit" class="btn btn-buy-now btn-lg w-100" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                </button>
            </div>
        </form>

        <div class="mt-3 d-flex gap-2 flex-wrap">
            <div class="perk-item"><div class="perk-icon"><i class="bi bi-truck"></i></div><small>Giao hàng toàn quốc</small></div>
            <div class="perk-item"><div class="perk-icon"><i class="bi bi-shield-check"></i></div><small>Bảo hành chính hãng</small></div>
            <div class="perk-item"><div class="perk-icon"><i class="bi bi-credit-card"></i></div><small>Trả góp 0%</small></div>
        </div>
    </div>
</div>

@if($product->description)
    <div class="bg-white rounded mt-4 p-4" style="box-shadow: 0 2px 8px rgba(0,0,0,.04);">
        <h5 class="fw-bold"><i class="bi bi-file-text"></i> Mô tả chi tiết</h5>
        <hr>
        <div>{!! nl2br(e($product->description)) !!}</div>
    </div>
@endif

@if($related->count())
<div class="section-title mt-5"><i class="bi bi-boxes"></i> Sản phẩm tương tự</div>
<div class="row">
    @foreach($related as $product)
        @include('frontend.partials.product_card', ['product' => $product])
    @endforeach
</div>
@endif
@endsection
