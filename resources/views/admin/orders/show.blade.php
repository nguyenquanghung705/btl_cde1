@extends('layouts.admin')
@section('title', 'Chi tiết đơn hàng')
@section('page_title', 'Đơn hàng ' . $order->order_code)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header"><strong>Sản phẩm</strong></div>
            <table class="table mb-0">
                <thead class="table-light"><tr><th>Sản phẩm</th><th>Giá</th><th>SL</th><th>Tổng</th></tr></thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ number_format($item->price) }}đ</td>
                            <td>{{ $item->quantity }}</td>
                            <td><strong>{{ number_format($item->subtotal) }}đ</strong></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr><th colspan="3" class="text-end">Tạm tính:</th><th>{{ number_format($order->total_amount) }}đ</th></tr>
                    <tr><th colspan="3" class="text-end">Phí ship:</th><th>{{ number_format($order->shipping_fee) }}đ</th></tr>
                    <tr><th colspan="3" class="text-end">Tổng:</th><th class="text-danger">{{ number_format($order->final_amount) }}đ</th></tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header"><strong>Thông tin khách hàng</strong></div>
            <div class="card-body">
                <p><strong>Tên:</strong> {{ $order->customer_name }}</p>
                <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                @if($order->note)<p><strong>Ghi chú:</strong> {{ $order->note }}</p>@endif
            </div>
        </div>

        <div class="card">
            <div class="card-header"><strong>Cập nhật trạng thái</strong></div>
            <div class="card-body">
                <p><strong>Phương thức:</strong> {{ strtoupper($order->payment_method) }}</p>
                <p><strong>Hiện tại:</strong> <span class="badge bg-info">{{ $order->status_label }}</span></p>
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select mb-2">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                        <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                        <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                    <button class="btn btn-primary w-100">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
