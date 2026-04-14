@extends('layouts.admin')
@section('title', 'Đơn hàng')
@section('page_title', 'Quản lý đơn hàng')

@section('content')
<div class="card">
    <div class="card-header">
        <form class="d-flex" method="GET">
            <select name="status" class="form-select" style="width: 200px">
                <option value="">Tất cả trạng thái</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                <option value="shipping" {{ request('status') == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
            <button class="btn btn-primary ms-2">Lọc</button>
        </form>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>Mã đơn</th><th>Khách hàng</th><th>SĐT</th><th>Tổng</th><th>Thanh toán</th><th>Trạng thái</th><th>Ngày</th><th></th></tr>
            </thead>
            <tbody>
                @forelse($orders as $o)
                    <tr>
                        <td><strong>{{ $o->order_code }}</strong></td>
                        <td>{{ $o->customer_name }}</td>
                        <td>{{ $o->customer_phone }}</td>
                        <td>{{ number_format($o->final_amount) }}đ</td>
                        <td><span class="badge bg-info">{{ strtoupper($o->payment_method) }}</span></td>
                        <td>
                            @php
                                $colors = ['pending'=>'warning','confirmed'=>'info','shipping'=>'primary','completed'=>'success','cancelled'=>'danger'];
                            @endphp
                            <span class="badge bg-{{ $colors[$o->status] ?? 'secondary' }}">{{ $o->status_label }}</span>
                        </td>
                        <td>{{ $o->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $o) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Chưa có đơn hàng</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $orders->links() }}</div>
</div>
@endsection
