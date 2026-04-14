<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laptop Shop - Cửa hàng laptop chính hãng')</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>

@php $cartCount = app(\App\Services\CartService::class)->count(); @endphp

<div class="topbar">
    <div class="container d-flex justify-content-between flex-wrap">
        <div>
            <a href="#"><i class="bi bi-telephone-fill"></i> Hotline: 1900-xxxx</a>
            <a href="#"><i class="bi bi-envelope-fill"></i> support@laptopshop.com</a>
        </div>
        <div class="d-none d-md-block">
            <a href="#"><i class="bi bi-truck"></i> Giao hàng toàn quốc</a>
            <a href="#"><i class="bi bi-shield-check"></i> Bảo hành chính hãng</a>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-main py-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-laptop"></i>Laptop Shop
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-3">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="bi bi-house-door"></i> Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}"><i class="bi bi-grid"></i> Sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index', ['category' => 1]) }}"><i class="bi bi-controller"></i> Gaming</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index', ['category' => 2]) }}"><i class="bi bi-briefcase"></i> Văn phòng</a></li>
            </ul>
            <form class="search-box me-3" action="{{ route('products.index') }}" method="GET">
                <input type="search" name="keyword" placeholder="Bạn tìm laptop gì hôm nay?" value="{{ request('keyword') }}">
                <button type="submit"><i class="bi bi-search"></i> Tìm</button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link cart-btn" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart3"></i> Giỏ hàng
                        <span class="cart-count">{{ $cartCount }}</span>
                    </a>
                </li>
                @auth
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-gear"></i> Admin</a></li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">@csrf
                                    <button class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Đăng nhập</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Đăng ký</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</main>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5><i class="bi bi-laptop"></i> Laptop Shop</h5>
                <p>Chuỗi cửa hàng laptop chính hãng uy tín - Giá tốt nhất thị trường, bảo hành dài lâu, giao hàng toàn quốc.</p>
                <div class="social-icons mt-3">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                    <a href="#"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
            <div class="col-md-2 col-6 mb-4">
                <h5>Về chúng tôi</h5>
                <a href="#">Giới thiệu</a>
                <a href="#">Tin tức</a>
                <a href="#">Tuyển dụng</a>
                <a href="#">Liên hệ</a>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <h5>Chính sách</h5>
                <a href="#">Bảo hành</a>
                <a href="#">Đổi trả</a>
                <a href="#">Giao hàng</a>
                <a href="#">Bảo mật</a>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Liên hệ</h5>
                <p class="mb-2"><i class="bi bi-geo-alt"></i> 123 Đường ABC, Hà Nội</p>
                <p class="mb-2"><i class="bi bi-telephone"></i> 1900-xxxx</p>
                <p class="mb-2"><i class="bi bi-envelope"></i> support@laptopshop.com</p>
                <p class="mb-0"><i class="bi bi-clock"></i> 8:00 - 22:00 hàng ngày</p>
            </div>
        </div>
        <hr style="border-color:rgba(255,255,255,0.1)">
        <p class="text-center mb-0" style="opacity:.7">&copy; {{ date('Y') }} Laptop Shop — Bài tập lớn Laravel.</p>
    </div>
</footer>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
@stack('scripts')
</body>
</html>
