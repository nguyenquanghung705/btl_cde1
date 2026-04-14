@extends('layouts.frontend')
@section('title', 'Trang chủ - Laptop Shop')

@section('content')
{{-- HERO BANNER --}}
<div class="mb-4" style="border-radius:16px; overflow:hidden;">
    <img src="/images/banners/hero.svg" alt="Laptop Shop" style="width:100%; display:block;">
</div>

{{-- PERKS --}}
<div class="perks">
    <div class="row g-3">
        <div class="col-md-3 col-6">
            <div class="perk-item">
                <div class="perk-icon"><i class="bi bi-truck"></i></div>
                <div><strong>Miễn phí vận chuyển</strong><small>Đơn từ 500K toàn quốc</small></div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="perk-item">
                <div class="perk-icon"><i class="bi bi-shield-check"></i></div>
                <div><strong>Bảo hành chính hãng</strong><small>Tới 36 tháng</small></div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="perk-item">
                <div class="perk-icon"><i class="bi bi-credit-card-2-front"></i></div>
                <div><strong>Trả góp 0%</strong><small>Qua thẻ tín dụng</small></div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="perk-item">
                <div class="perk-icon"><i class="bi bi-arrow-counterclockwise"></i></div>
                <div><strong>Đổi trả 30 ngày</strong><small>Lỗi do NSX</small></div>
            </div>
        </div>
    </div>
</div>

{{-- CATEGORIES --}}
<div class="section-title">
    <i class="bi bi-grid-fill"></i> Danh mục
</div>
<div class="row g-3 mb-4">
    @php
        $catIcons = [
            'Laptop Gaming' => 'bi-controller',
            'Laptop Văn phòng' => 'bi-briefcase-fill',
            'Laptop Đồ họa' => 'bi-palette-fill',
            'Laptop Sinh viên' => 'bi-mortarboard-fill',
        ];
    @endphp
    @foreach($categories as $cat)
        <div class="col-md-3 col-6">
            <a href="{{ route('products.index', ['category' => $cat->id]) }}">
                <div class="cat-tile">
                    <div class="cat-icon">
                        <i class="bi {{ $catIcons[$cat->name] ?? 'bi-laptop' }}"></i>
                    </div>
                    <h6>{{ $cat->name }}</h6>
                    <small>{{ $cat->description }}</small>
                </div>
            </a>
        </div>
    @endforeach
</div>

{{-- FEATURED --}}
@if($featured->count())
<div class="section-title">
    <i class="bi bi-star-fill text-warning"></i> Sản phẩm nổi bật
    <a href="{{ route('products.index') }}" class="view-more">Xem tất cả <i class="bi bi-arrow-right"></i></a>
</div>
<div class="row">
    @foreach($featured as $product)
        @include('frontend.partials.product_card', ['product' => $product])
    @endforeach
</div>
@endif

{{-- BANNERS SECTION --}}
<div class="row g-3 my-2">
    <div class="col-md-6">
        <a href="{{ route('products.index', ['category' => 1]) }}">
            <img src="/images/banners/gaming.svg" alt="Gaming" style="width:100%; border-radius:14px; display:block;">
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('products.index', ['category' => 2]) }}">
            <img src="/images/banners/office.svg" alt="Văn phòng" style="width:100%; border-radius:14px; display:block;">
        </a>
    </div>
</div>

{{-- NEW PRODUCTS --}}
@if($newProducts->count())
<div class="section-title">
    <i class="bi bi-fire text-danger"></i> Sản phẩm mới về
    <a href="{{ route('products.index', ['sort' => 'newest']) }}" class="view-more">Xem tất cả <i class="bi bi-arrow-right"></i></a>
</div>
<div class="row">
    @foreach($newProducts as $product)
        @include('frontend.partials.product_card', ['product' => $product])
    @endforeach
</div>
@endif

{{-- BRANDS --}}
<div class="section-title">
    <i class="bi bi-award-fill text-info"></i> Thương hiệu nổi bật
</div>
<div class="row g-3 mb-4">
    @foreach($brands as $brand)
        <div class="col-md-2 col-4">
            <a href="{{ route('products.index', ['brand' => $brand->id]) }}">
                <div class="brand-chip">
                    <img src="/images/brands/{{ strtolower($brand->name) }}.svg"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block'"
                         alt="{{ $brand->name }}">
                    <span style="display:none">{{ $brand->name }}</span>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection
