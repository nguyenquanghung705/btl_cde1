@extends('layouts.frontend')
@section('title', 'Giỏ hàng')

@section('content')
<h2 class="mb-4"><i class="bi bi-cart3"></i> Giỏ hàng của bạn</h2>

@if(count($products) == 0)
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Giỏ hàng đang trống.
        <a href="{{ route('products.index') }}" class="alert-link">Mua sắm ngay</a>
    </div>
@else
    <div class="bg-white rounded p-3" style="box-shadow: 0 2px 8px rgba(0,0,0,.04);">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th style="width: 180px;">Số lượng</th>
                    <th>Tổng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $item)
                    <tr>
                        <td>
                            <img src="{{ $item['product']->image }}" onerror="this.src='https://placehold.co/60'"
                                 width="60" class="me-2" style="border-radius:6px; background:#f4f6fa; padding:4px;">
                            <strong>{{ $item['product']->name }}</strong>
                        </td>
                        <td>{{ number_format($item['price']) }}₫</td>
                        <td>
                            <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="d-flex">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                       min="1" max="99" class="form-control form-control-sm" style="width:70px">
                                <button class="btn btn-sm btn-outline-primary ms-1">OK</button>
                            </form>
                        </td>
                        <td class="price">{{ number_format($item['subtotal']) }}₫</td>
                        <td>
                            <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Tổng cộng:</th>
                    <th colspan="2"><span class="price h4">{{ number_format($total) }}₫</span></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-3 flex-wrap gap-2">
        <form action="{{ route('cart.clear') }}" method="POST"
              onsubmit="return confirm('Xóa toàn bộ giỏ hàng?');">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger"><i class="bi bi-trash"></i> Xóa toàn bộ</button>
        </form>
        <div class="d-flex gap-2">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Tiếp tục mua
            </a>
            <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">
                <i class="bi bi-credit-card"></i> Thanh toán
            </a>
        </div>
    </div>
@endif
@endsection
