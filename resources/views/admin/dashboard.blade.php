@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card primary">
            <div class="card-body">
                <small class="text-muted">SẢN PHẨM</small>
                <h2 class="mb-0">{{ $stats['total_products'] }}</h2>
                <i class="bi bi-laptop text-primary"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card success">
            <div class="card-body">
                <small class="text-muted">ĐƠN HÀNG</small>
                <h2 class="mb-0">{{ $stats['total_orders'] }}</h2>
                <i class="bi bi-cart text-success"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card warning">
            <div class="card-body">
                <small class="text-muted">KHÁCH HÀNG</small>
                <h2 class="mb-0">{{ $stats['total_customers'] }}</h2>
                <i class="bi bi-people text-warning"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card danger">
            <div class="card-body">
                <small class="text-muted">CHỜ XỬ LÝ</small>
                <h2 class="mb-0">{{ $stats['pending_orders'] }}</h2>
                <i class="bi bi-clock text-danger"></i>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted">DOANH THU HÔM NAY</h6>
                <h3 class="text-success">{{ number_format($stats['revenue_today']) }}đ</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted">DOANH THU THÁNG NÀY</h6>
                <h3 class="text-primary">{{ number_format($stats['revenue_month']) }}đ</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Doanh thu 7 ngày gần nhất</strong></div>
            <div class="card-body">
                <canvas id="chartRevenue" height="80"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><strong>Đơn hàng gần đây</strong></div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    @foreach($recent as $o)
                        <tr>
                            <td>
                                <a href="{{ route('admin.orders.show', $o) }}">{{ $o->order_code }}</a>
                                <br><small class="text-muted">{{ $o->customer_name }}</small>
                            </td>
                            <td class="text-end">
                                <strong>{{ number_format($o->final_amount) }}đ</strong>
                                <br><span class="badge bg-secondary">{{ $o->status_label }}</span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
new Chart(document.getElementById('chartRevenue'), {
    type: 'line',
    data: {
        labels: {!! json_encode(array_column($chartData, 'date')) !!},
        datasets: [{
            label: 'Doanh thu (VNĐ)',
            data: {!! json_encode(array_column($chartData, 'revenue')) !!},
            borderColor: '#3498db',
            backgroundColor: 'rgba(52,152,219,.1)',
            tension: 0.3,
            fill: true
        }]
    }
});
</script>
@endpush
@endsection
