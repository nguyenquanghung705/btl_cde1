@extends('layouts.auth')
@section('title', 'Đăng nhập')

@section('side_title')
    <h1>Chào mừng trở lại <br>với <span style="color:#ff6b35">Laptop Shop</span>!</h1>
@endsection

@section('side_body')
    <p>Đăng nhập để theo dõi đơn hàng, nhận ưu đãi thành viên và khám phá hàng ngàn mẫu laptop chính hãng.</p>
@endsection

@section('content')
    <h2 class="auth-title">Đăng nhập</h2>
    <p class="auth-subtitle">Chào mừng bạn quay lại! Vui lòng nhập thông tin để tiếp tục.</p>

    @if($errors->any() && !$errors->has('email') && !$errors->has('password'))
        <div class="alert-inline"><i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <div class="form-group-auth">
            <label for="email">Email</label>
            <div class="input-wrap">
                <i class="bi bi-envelope input-icon"></i>
                <input id="email" type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       placeholder="you@example.com"
                       required autofocus autocomplete="email">
            </div>
            @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>

        <div class="form-group-auth">
            <label for="password">Mật khẩu</label>
            <div class="input-wrap">
                <i class="bi bi-lock input-icon"></i>
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="••••••••"
                       required autocomplete="current-password">
                <button type="button" class="toggle-pw"><i class="bi bi-eye"></i></button>
            </div>
            @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>

        <div class="auth-options">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
            @endif
        </div>

        <button type="submit" class="btn-auth">
            <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
        </button>

        <div class="auth-divider">hoặc đăng nhập với</div>

        <div class="d-flex gap-2">
            <button type="button" class="btn-social gg"><i class="bi bi-google"></i> Google</button>
            <button type="button" class="btn-social fb"><i class="bi bi-facebook"></i> Facebook</button>
        </div>

        <p class="auth-switch">
            Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
        </p>
    </form>
@endsection
