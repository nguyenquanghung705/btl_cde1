@extends('layouts.frontend')
@section('title', 'Đặt hàng thành công')

@section('content')
<div class="text-center my-5">
    <i class="bi bi-check-circle-fill text-success" style="font-size: 80px;"></i>
    <h2 class="mt-3">Đặt hàng thành công!</h2>
    <p class="lead">Mã đơn hàng: <strong>{{ $order->order_code }}</strong></p>
    <p>Cảm ơn bạn! Chúng tôi sẽ liên hệ xác nhận trong thời gian sớm nhất.</p>
</div>

<div class="card">
    <div class="card-header"><strong>Chi tiết đơn hàng</strong></div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>Người nhận:</strong> {{ $order->customer_name }}</p>
                <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Thanh toán:</strong> {{ strtoupper($order->payment_method) }}</p>
                <p><strong>Trạng thái:</strong> <span class="badge bg-warning">{{ $order->status_label }}</span></p>
                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr><th>Sản phẩm</th><th>Giá</th><th>SL</th><th>Tổng</th></tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ number_format($item->price) }}đ</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->subtotal) }}đ</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr><th colspan="3" class="text-end">Tạm tính:</th><th>{{ number_format($order->total_amount) }}đ</th></tr>
                <tr><th colspan="3" class="text-end">Phí ship:</th><th>{{ number_format($order->shipping_fee) }}đ</th></tr>
                <tr><th colspan="3" class="text-end">Tổng thanh toán:</th><th class="price">{{ number_format($order->final_amount) }}đ</th></tr>
            </tfoot>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-primary">Về trang chủ</a>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Tiếp tục mua sắm</a>
        </div>
    </div>
</div>
@endsection
