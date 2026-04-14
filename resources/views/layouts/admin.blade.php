<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Laptop Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .sidebar { background: #2c3e50; min-height: 100vh; color: #ecf0f1; }
        .sidebar a { color: #bdc3c7; padding: 12px 20px; display: block; text-decoration: none; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; color: #fff; border-left: 3px solid #3498db; }
        .sidebar h4 { padding: 20px; border-bottom: 1px solid #34495e; margin: 0; }
        .stat-card { border-left: 4px solid; }
        .stat-card.primary { border-left-color: #3498db; }
        .stat-card.success { border-left-color: #2ecc71; }
        .stat-card.warning { border-left-color: #f39c12; }
        .stat-card.danger { border-left-color: #e74c3c; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar p-0">
            <h4><i class="bi bi-speedometer2"></i> Admin</h4>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-laptop"></i> Sản phẩm
            </a>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-folder"></i> Danh mục
            </a>
            <a href="{{ route('admin.brands.index') }}" class="{{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                <i class="bi bi-award"></i> Hãng sản xuất
            </a>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-cart"></i> Đơn hàng
            </a>
            <a href="{{ route('home') }}" target="_blank">
                <i class="bi bi-arrow-up-right-square"></i> Xem website
            </a>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button class="btn w-100 text-start" style="color:#bdc3c7; padding: 12px 20px; border:0; background:transparent">
                    <i class="bi bi-box-arrow-right"></i> Đăng xuất
                </button>
            </form>
        </nav>

        <main class="col-md-10 p-4">
            <div class="d-flex justify-content-between mb-4">
                <h3>@yield('page_title')</h3>
                <div>
                    <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stack('scripts')
</body>
</html>
