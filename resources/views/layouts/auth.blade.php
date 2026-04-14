<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Xác thực') | Laptop Shop</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet">
    @stack('head')
</head>
<body>
<div class="auth-wrapper">
    <aside class="auth-side">
        <a href="{{ url('/') }}" class="auth-logo">
            <i class="bi bi-laptop"></i>Laptop Shop
        </a>
        <div class="auth-hero">
            @yield('side_title', 'Công nghệ đỉnh cao, giá tốt mỗi ngày.')
            @yield('side_body')
            <ul class="auth-features">
                <li><span class="feat-icon"><i class="bi bi-truck"></i></span> Giao hàng toàn quốc, nhận trong 24h</li>
                <li><span class="feat-icon"><i class="bi bi-shield-check"></i></span> Bảo hành chính hãng đến 36 tháng</li>
                <li><span class="feat-icon"><i class="bi bi-credit-card-2-front"></i></span> Trả góp 0% qua thẻ tín dụng</li>
                <li><span class="feat-icon"><i class="bi bi-headset"></i></span> Tư vấn chuyên nghiệp 24/7</li>
            </ul>
        </div>
        <p class="auth-footer-note">&copy; {{ date('Y') }} Laptop Shop — Bài tập lớn Laravel.</p>
    </aside>

    <main class="auth-form-panel">
        <a href="{{ url('/') }}" class="back-home"><i class="bi bi-arrow-left"></i> Về trang chủ</a>
        <div class="auth-form-wrap">
            @yield('content')
        </div>
    </main>
</div>

<script src="{{ asset('assets/js/auth.js') }}"></script>
</body>
</html>
