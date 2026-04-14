<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laptop Shop - Cửa hàng laptop chính hãng')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-1: #1e3c72;
            --brand-2: #2a5298;
            --accent: #ff6b35;
            --sale: #e74c3c;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Be Vietnam Pro', 'Segoe UI', sans-serif;
            background: #f4f6fa;
            color: #2c3e50;
        }
        a { text-decoration: none; }

        /* Top bar */
        .topbar {
            background: #0f1e3d;
            color: #d7e0f0;
            font-size: .85rem;
            padding: 6px 0;
        }
        .topbar a { color: #d7e0f0; margin-right: 14px; }
        .topbar a:hover { color: #fff; }

        /* Navbar */
        .navbar-main {
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            box-shadow: 0 2px 12px rgba(30,60,114,0.2);
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: #fff !important;
            letter-spacing: .5px;
        }
        .navbar-brand i {
            background: #fff;
            color: var(--brand-1);
            padding: 6px 10px;
            border-radius: 8px;
            margin-right: 6px;
        }
        .navbar-main .nav-link {
            color: rgba(255,255,255,0.92) !important;
            font-weight: 500;
            padding: 8px 14px !important;
            border-radius: 6px;
            transition: all .2s;
        }
        .navbar-main .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: #fff !important;
        }
        .search-box {
            background: #fff;
            border-radius: 28px;
            padding: 4px;
            min-width: 360px;
            display: flex;
        }
        .search-box input {
            border: 0;
            outline: 0;
            background: transparent;
            padding: 6px 14px;
            flex: 1;
            font-size: .95rem;
        }
        .search-box button {
            background: var(--accent);
            color: #fff;
            border: 0;
            border-radius: 24px;
            padding: 6px 18px;
            font-weight: 600;
        }
        .cart-btn {
            background: rgba(255,255,255,0.15);
            border-radius: 24px;
            padding: 6px 14px !important;
            color: #fff !important;
        }
        .cart-btn:hover { background: rgba(255,255,255,0.25); }
        .cart-count {
            background: var(--accent);
            color: #fff;
            border-radius: 12px;
            padding: 2px 8px;
            font-size: .75rem;
            font-weight: 700;
            margin-left: 4px;
        }

        /* Product card */
        .product-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            transition: transform .25s, box-shadow .25s;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            border: 1px solid #eef1f7;
        }
        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(30,60,114,0.15);
            border-color: var(--brand-2);
        }
        .product-img-wrap {
            background: linear-gradient(135deg, #f8fafd 0%, #eef2fa 100%);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200px;
        }
        .product-img-wrap img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform .3s;
        }
        .product-card:hover .product-img-wrap img { transform: scale(1.05); }
        .product-body { padding: 16px; flex: 1; display: flex; flex-direction: column; }
        .product-title {
            font-size: .95rem;
            font-weight: 600;
            color: #2c3e50;
            min-height: 44px;
            margin-bottom: 8px;
            line-height: 1.35;
        }
        .product-title a { color: inherit; }
        .product-title a:hover { color: var(--brand-2); }
        .product-specs {
            font-size: .8rem;
            color: #7f8c8d;
            margin-bottom: 10px;
            min-height: 36px;
        }
        .product-specs i { color: var(--brand-2); margin-right: 4px; }
        .price {
            color: var(--sale);
            font-weight: 800;
            font-size: 1.15rem;
        }
        .price-old {
            text-decoration: line-through;
            color: #95a5a6;
            font-size: .85rem;
            margin-left: 6px;
        }
        .badge-sale {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--sale);
            color: #fff;
            font-weight: 700;
            font-size: .75rem;
            padding: 4px 10px;
            border-radius: 20px;
            z-index: 2;
        }
        .badge-new {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #27ae60;
            color: #fff;
            font-weight: 700;
            font-size: .7rem;
            padding: 4px 10px;
            border-radius: 20px;
            z-index: 2;
        }
        .btn-cart {
            background: var(--brand-2);
            color: #fff;
            border: 0;
            border-radius: 8px;
            padding: 8px;
            font-weight: 600;
            font-size: .9rem;
            transition: background .2s;
            width: 100%;
            margin-top: auto;
        }
        .btn-cart:hover { background: var(--brand-1); color: #fff; }

        /* Section heading */
        .section-title {
            font-weight: 800;
            font-size: 1.4rem;
            margin: 24px 0 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-title::before {
            content: '';
            width: 4px;
            height: 24px;
            background: var(--accent);
            border-radius: 2px;
        }
        .section-title .view-more {
            margin-left: auto;
            font-size: .9rem;
            font-weight: 500;
            color: var(--brand-2);
        }

        /* Category tile */
        .cat-tile {
            background: #fff;
            border-radius: 14px;
            padding: 22px 16px;
            text-align: center;
            transition: all .25s;
            border: 1px solid #eef1f7;
            height: 100%;
        }
        .cat-tile:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(30,60,114,0.12);
            border-color: var(--brand-2);
        }
        .cat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.7rem;
            color: #fff;
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        }
        .cat-tile h6 { font-weight: 700; margin: 0; color: #2c3e50; }
        .cat-tile small { color: #7f8c8d; font-size: .75rem; }

        /* Brand strip */
        .brand-chip {
            background: #fff;
            border: 1px solid #eef1f7;
            border-radius: 12px;
            padding: 18px;
            text-align: center;
            font-weight: 700;
            color: #2c3e50;
            transition: all .2s;
            height: 100%;
        }
        .brand-chip:hover {
            border-color: var(--brand-2);
            color: var(--brand-2);
            transform: translateY(-2px);
        }
        .brand-chip img { max-height: 36px; }

        /* Perks row */
        .perks { background: #fff; border-radius: 14px; padding: 18px; margin: 20px 0; }
        .perk-item { display: flex; align-items: center; gap: 12px; }
        .perk-icon {
            width: 44px; height: 44px; border-radius: 10px;
            background: #eaf1fb; color: var(--brand-2);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; flex-shrink: 0;
        }
        .perk-item strong { display: block; font-size: .9rem; }
        .perk-item small { color: #7f8c8d; }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #0f1e3d, #1a2d5c);
            color: #d7e0f0;
            padding: 50px 0 20px;
            margin-top: 60px;
        }
        footer h5 { color: #fff; font-weight: 700; margin-bottom: 16px; }
        footer a { color: #d7e0f0; display: block; padding: 4px 0; }
        footer a:hover { color: var(--accent); }
        .social-icons a {
            display: inline-flex; width: 38px; height: 38px;
            background: rgba(255,255,255,0.1); border-radius: 50%;
            align-items: center; justify-content: center;
            margin-right: 8px;
        }
        .social-icons a:hover { background: var(--accent); color: #fff; }
    </style>
</head>
<body>

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
                        <span class="cart-count">{{ count(session('cart', [])) }}</span>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
