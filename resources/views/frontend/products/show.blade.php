@extends('layouts.frontend')
@section('title', $product->name)

@section('content')
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
        <li class="breadcrumb-item active">{{ $product->name }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-5">
        <div class="card p-3">
            <img src="{{ $product->image ?: 'https://placehold.co/500x400?text=Laptop' }}"
                 onerror="this.src='https://placehold.co/500x400?text=Laptop'"
                 class="img-fluid" alt="{{ $product->name }}">
        </div>
    </div>

    <div class="col-md-7">
        <h2>{{ $product->name }}</h2>
        <p class="text-muted">
            <i class="bi bi-tag"></i> {{ $product->brand->name }} |
            <i class="bi bi-folder"></i> {{ $product->category->name }} |
            <i class="bi bi-eye"></i> {{ $product->views }} lượt xem
        </p>

        <div class="my-3 p-3 bg-light rounded">
            <span class="price h3">{{ number_format($product->display_price) }}đ</span>
            @if($product->sale_price)
                <span class="price-old ms-2">{{ number_format($product->price) }}đ</span>
                <span class="badge bg-danger ms-2">Tiết kiệm {{ $product->discount_percent }}%</span>
            @endif
        </div>

        <table class="table table-bordered table-sm">
            <tbody>
                <tr><th width="150">CPU</th><td>{{ $product->cpu }}</td></tr>
                <tr><th>RAM</th><td>{{ $product->ram }}</td></tr>
                <tr><th>Ổ cứng</th><td>{{ $product->storage }}</td></tr>
                <tr><th>Card đồ họa</th><td>{{ $product->gpu }}</td></tr>
                <tr><th>Màn hình</th><td>{{ $product->screen }}</td></tr>
                <tr><th>Hệ điều hành</th><td>{{ $product->os }}</td></tr>
                <tr><th>Cân nặng</th><td>{{ $product->weight }} kg</td></tr>
                <tr><th>Pin</th><td>{{ $product->battery }}</td></tr>
                <tr><th>Bảo hành</th><td>{{ $product->warranty }}</td></tr>
                <tr><th>Tồn kho</th><td>
                    @if($product->stock > 0)
                        <span class="text-success">Còn {{ $product->stock }} sản phẩm</span>
                    @else
                        <span class="text-danger">Hết hàng</span>
                    @endif
                </td></tr>
            </tbody>
        </table>

        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="row g-2 align-items-end">
            @csrf
            <div class="col-3">
                <label>Số lượng</label>
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control">
            </div>
            <div class="col-9">
                <button type="submit" class="btn btn-primary btn-lg w-100" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                </button>
            </div>
        </form>
    </div>
</div>

@if($product->description)
    <div class="card mt-4">
        <div class="card-header"><strong>Mô tả chi tiết</strong></div>
        <div class="card-body">{!! nl2br(e($product->description)) !!}</div>
    </div>
@endif

@if($related->count())
<h4 class="mt-5">Sản phẩm liên quan</h4>
<div class="row">
    @foreach($related as $product)
        @include('frontend.partials.product_card', ['product' => $product])
    @endforeach
</div>
@endif
@endsection
