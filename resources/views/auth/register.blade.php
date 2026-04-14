@extends('layouts.auth')
@section('title', 'Đăng ký')

@section('side_title')
    <h1>Tham gia cộng đồng <br><span style="color:#ff6b35">Laptop Shop</span> hôm nay!</h1>
@endsection

@section('side_body')
    <p>Tạo tài khoản miễn phí để nhận ưu đãi thành viên, theo dõi đơn hàng và tích điểm mỗi khi mua sắm.</p>
@endsection

@section('content')
    <h2 class="auth-title">Đăng ký tài khoản</h2>
    <p class="auth-subtitle">Chỉ mất 30 giây — bắt đầu hành trình mua sắm thông minh.</p>

    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <div class="form-group-auth">
            <label for="name">Họ và tên</label>
            <div class="input-wrap">
                <i class="bi bi-person input-icon"></i>
                <input id="name" type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="Nguyễn Văn A"
                       required autofocus autocomplete="name">
            </div>
            @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>

        <div class="form-group-auth">
            <label for="email">Email</label>
            <div class="input-wrap">
                <i class="bi bi-envelope input-icon"></i>
                <input id="email" type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       placeholder="you@example.com"
                       required autocomplete="email">
            </div>
            @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>

        <div class="form-group-auth">
            <label for="password">Mật khẩu</label>
            <div class="input-wrap">
                <i class="bi bi-lock input-icon"></i>
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Ít nhất 8 ký tự"
                       required autocomplete="new-password">
                <button type="button" class="toggle-pw"><i class="bi bi-eye"></i></button>
            </div>
            @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>

        <div class="form-group-auth">
            <label for="password-confirm">Xác nhận mật khẩu</label>
            <div class="input-wrap">
                <i class="bi bi-shield-lock input-icon"></i>
                <input id="password-confirm" type="password" name="password_confirmation"
                       class="form-control"
                       placeholder="Nhập lại mật khẩu"
                       required autocomplete="new-password">
                <button type="button" class="toggle-pw"><i class="bi bi-eye"></i></button>
            </div>
        </div>

        <div class="auth-options" style="margin-top: 8px;">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="agree" required>
                <label class="form-check-label" for="agree" style="font-size:.85rem">
                    Tôi đồng ý với <a href="#">Điều khoản</a> và <a href="#">Chính sách bảo mật</a>
                </label>
            </div>
        </div>

        <button type="submit" class="btn-auth">
            <i class="bi bi-person-plus"></i> Tạo tài khoản
        </button>

        <div class="auth-divider">hoặc đăng ký với</div>

        <div class="d-flex gap-2">
            <button type="button" class="btn-social gg"><i class="bi bi-google"></i> Google</button>
            <button type="button" class="btn-social fb"><i class="bi bi-facebook"></i> Facebook</button>
        </div>

        <p class="auth-switch">
            Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>
        </p>
    </form>
@endsection
