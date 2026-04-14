@extends('layouts.frontend')
@section('title', 'Thanh toán')

@section('content')
<h2><i class="bi bi-credit-card"></i> Thanh toán</h2>

<form action="{{ route('checkout.placeOrder') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-7">
            <div class="card mb-3">
                <div class="card-header"><strong>Thông tin giao hàng</strong></div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label>Họ tên *</label>
                        <input name="customer_name" class="form-control" required value="{{ old('customer_name', auth()->user()->name ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label>Số điện thoại *</label>
                        <input name="customer_phone" class="form-control" required value="{{ old('customer_phone', auth()->user()->phone ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label>Email *</label>
                        <input name="customer_email" type="email" class="form-control" required value="{{ old('customer_email', auth()->user()->email ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label>Địa chỉ giao hàng *</label>
                        <textarea name="shipping_address" class="form-control" required rows="3">{{ old('shipping_address', auth()->user()->address ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Ghi chú</label>
                        <textarea name="note" class="form-control" rows="2">{{ old('note') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header"><strong>Phương thức thanh toán</strong></div>
                <div class="card-body">
                    <div class="form-check"><input type="radio" name="payment_method" value="cod" class="form-check-input" checked id="pm1"><label for="pm1" class="form-check-label">Thanh toán khi nhận hàng (COD)</label></div>
                    <div class="form-check"><input type="radio" name="payment_method" value="bank_transfer" class="form-check-input" id="pm2"><label for="pm2" class="form-check-label">Chuyển khoản ngân hàng</label></div>
                    <div class="form-check"><input type="radio" name="payment_method" value="vnpay" class="form-check-input" id="pm3"><label for="pm3" class="form-check-label">VNPay</label></div>
                    <div class="form-check"><input type="radio" name="payment_method" value="momo" class="form-check-input" id="pm4"><label for="pm4" class="form-check-label">Ví Momo</label></div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><strong>Đơn hàng</strong></div>
                <div class="card-body">
                    @foreach($products as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ Str::limit($item['product']->name, 30) }} x {{ $item['quantity'] }}</span>
                            <span>{{ number_format($item['subtotal']) }}đ</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between"><span>Tạm tính:</span><strong>{{ number_format($total) }}đ</strong></div>
                    <div class="d-flex justify-content-between"><span>Phí ship:</span><strong>{{ $total >= 20000000 ? 'Miễn phí' : '50.000đ' }}</strong></div>
                    <hr>
                    <div class="d-flex justify-content-between h5"><span>Tổng:</span><span class="price">{{ number_format($total + ($total >= 20000000 ? 0 : 50000)) }}đ</span></div>

                    <button type="submit" class="btn btn-success btn-lg w-100 mt-3">
                        <i class="bi bi-check-circle"></i> Đặt hàng
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
