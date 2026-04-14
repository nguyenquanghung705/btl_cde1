@extends('layouts.frontend')
@section('title', 'Trang chủ - Laptop Shop')

@section('content')
<div class="bg-primary text-white rounded p-5 mb-4 text-center">
    <h1><i class="bi bi-laptop"></i> Chào mừng đến Laptop Shop</h1>
    <p class="lead">Hơn 100+ mẫu laptop chính hãng từ Dell, HP, Asus, Apple...</p>
    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg">Xem sản phẩm <i class="bi bi-arrow-right"></i></a>
</div>

<h3 class="mb-3"><i class="bi bi-tags-fill text-primary"></i> Danh mục</h3>
<div class="row mb-5">
    @foreach($categories as $cat)
        <div class="col-md-3 col-6 mb-3">
            <a href="{{ route('products.index', ['category' => $cat->id]) }}" class="text-decoration-none">
                <div class="card text-center p-3 h-100">
                    <i class="bi bi-laptop display-4 text-primary"></i>
                    <h6 class="mt-2">{{ $cat->name }}</h6>
                </div>
            </a>
        </div>
    @endforeach
</div>

<h3 class="mb-3"><i class="bi bi-star-fill text-warning"></i> Sản phẩm nổi bật</h3>
<div class="row">
    @foreach($featured as $product)
        @include('frontend.partials.product_card', ['product' => $product])
    @endforeach
</div>

@if($newProducts->count())
<h3 class="mb-3 mt-5"><i class="bi bi-fire text-danger"></i> Sản phẩm mới</h3>
<div class="row">
    @foreach($newProducts as $product)
        @include('frontend.partials.product_card', ['product' => $product])
    @endforeach
</div>
@endif

<h3 class="mb-3 mt-5"><i class="bi bi-award-fill text-info"></i> Thương hiệu</h3>
<div class="row text-center">
    @foreach($brands as $brand)
        <div class="col-md-2 col-4 mb-3">
            <div class="card p-3">
                <strong>{{ $brand->name }}</strong>
            </div>
        </div>
    @endforeach
</div>
@endsection
