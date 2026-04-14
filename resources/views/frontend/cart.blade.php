@extends('layouts.frontend')
@section('title', 'Giỏ hàng')

@section('content')
<h2><i class="bi bi-cart3"></i> Giỏ hàng</h2>

@if(count($products) == 0)
    <div class="alert alert-info">Giỏ hàng của bạn đang trống. <a href="{{ route('products.index') }}">Mua sắm ngay</a></div>
@else
    <table class="table">
        <thead class="table-light">
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $item)
                <tr>
                    <td>
                        <img src="{{ $item['product']->image }}" onerror="this.src='https://placehold.co/60'" width="60" class="me-2">
                        <strong>{{ $item['product']->name }}</strong>
                    </td>
                    <td>{{ number_format($item['price']) }}đ</td>
                    <td>
                        <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="d-flex">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm" style="width:70px">
                            <button class="btn btn-sm btn-outline-primary ms-1">OK</button>
                        </form>
                    </td>
                    <td><strong>{{ number_format($item['subtotal']) }}đ</strong></td>
                    <td><a href="{{ route('cart.remove', $item['product']->id) }}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a></td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Tổng cộng:</th>
                <th colspan="2" class="price h4">{{ number_format($total) }}đ</th>
            </tr>
        </tfoot>
    </table>

    <div class="text-end">
        <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger">Xóa toàn bộ</a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Tiếp tục mua</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg"><i class="bi bi-credit-card"></i> Thanh toán</a>
    </div>
@endif
@endsection
