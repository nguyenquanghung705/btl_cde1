<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Xác thực') | Laptop Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-1: #1e3c72;
            --brand-2: #2a5298;
            --accent: #ff6b35;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Be Vietnam Pro', 'Segoe UI', sans-serif;
            margin: 0;
            min-height: 100vh;
            background: #f4f6fa;
        }
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: stretch;
        }

        /* Left panel — branding */
        .auth-side {
            flex: 1;
            background:
                radial-gradient(circle at 20% 20%, rgba(255,107,53,0.25), transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255,255,255,0.1), transparent 50%),
                linear-gradient(135deg, var(--brand-1) 0%, var(--brand-2) 100%);
            color: #fff;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .auth-side::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 400px; height: 400px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
        }
        .auth-side::after {
            content: '';
            position: absolute;
            bottom: -150px; left: -150px;
            width: 450px; height: 450px;
            background: rgba(255,107,53,0.1);
            border-radius: 50%;
        }
        .auth-logo {
            font-size: 1.7rem;
            font-weight: 800;
            color: #fff;
            text-decoration: none;
            position: relative;
            z-index: 1;
        }
        .auth-logo i {
            background: #fff;
            color: var(--brand-1);
            padding: 8px 12px;
            border-radius: 10px;
            margin-right: 8px;
        }
        .auth-hero {
            position: relative;
            z-index: 1;
            max-width: 520px;
        }
        .auth-hero h1 {
            font-size: 2.4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 16px;
        }
        .auth-hero p {
            font-size: 1.05rem;
            opacity: 0.92;
            line-height: 1.6;
        }
        .auth-features {
            list-style: none;
            padding: 0;
            margin-top: 28px;
        }
        .auth-features li {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 10px 0;
            font-size: .95rem;
        }
        .auth-features .feat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .auth-footer-note {
            position: relative;
            z-index: 1;
            font-size: .85rem;
            opacity: 0.7;
        }

        /* Right panel — form */
        .auth-form-panel {
            flex: 1;
            background: #fff;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }
        .auth-form-wrap {
            max-width: 440px;
            width: 100%;
            margin: 0 auto;
        }
        .auth-title {
            font-size: 1.9rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 6px;
        }
        .auth-subtitle {
            color: #7f8c8d;
            margin-bottom: 28px;
        }

        .form-group-auth { margin-bottom: 16px; }
        .form-group-auth label {
            display: block;
            font-size: .88rem;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }
        .input-wrap {
            position: relative;
        }
        .input-wrap .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
            pointer-events: none;
        }
        .input-wrap .form-control {
            padding: 12px 14px 12px 42px;
            border-radius: 10px;
            border: 1px solid #dfe4ea;
            font-size: .95rem;
            transition: all .2s;
            width: 100%;
        }
        .input-wrap .form-control:focus {
            border-color: var(--brand-2);
            box-shadow: 0 0 0 3px rgba(42,82,152,0.12);
            outline: 0;
        }
        .input-wrap .form-control.is-invalid {
            border-color: #e74c3c;
        }
        .input-wrap .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: 0;
            color: #95a5a6;
            cursor: pointer;
        }
        .invalid-feedback {
            display: block;
            font-size: .82rem;
            color: #e74c3c;
            margin-top: 4px;
        }

        .auth-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 14px 0 22px;
            font-size: .88rem;
        }
        .auth-options a { color: var(--brand-2); text-decoration: none; font-weight: 600; }
        .auth-options a:hover { text-decoration: underline; }
        .form-check-input:checked {
            background-color: var(--brand-2);
            border-color: var(--brand-2);
        }

        .btn-auth {
            width: 100%;
            padding: 13px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: transform .15s, box-shadow .2s;
        }
        .btn-auth:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(30,60,114,0.3);
        }

        .auth-divider {
            text-align: center;
            margin: 22px 0;
            color: #95a5a6;
            font-size: .85rem;
            position: relative;
        }
        .auth-divider::before, .auth-divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: calc(50% - 30px);
            height: 1px;
            background: #e6eaf0;
        }
        .auth-divider::before { left: 0; }
        .auth-divider::after { right: 0; }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 11px;
            border: 1px solid #dfe4ea;
            background: #fff;
            border-radius: 10px;
            font-weight: 600;
            color: #2c3e50;
            cursor: pointer;
            transition: all .15s;
        }
        .btn-social:hover { border-color: var(--brand-2); background: #f8fafd; }
        .btn-social i { font-size: 1.2rem; }
        .btn-social.fb i { color: #1877F2; }
        .btn-social.gg i { color: #DB4437; }

        .auth-switch {
            text-align: center;
            margin-top: 26px;
            font-size: .92rem;
            color: #7f8c8d;
        }
        .auth-switch a {
            color: var(--brand-2);
            font-weight: 700;
            text-decoration: none;
        }
        .auth-switch a:hover { text-decoration: underline; }

        .back-home {
            position: absolute;
            top: 24px;
            right: 24px;
            color: #7f8c8d;
            text-decoration: none;
            font-size: .88rem;
            font-weight: 600;
        }
        .back-home:hover { color: var(--brand-2); }

        .alert-inline {
            background: #fef5f2;
            border-left: 3px solid #e74c3c;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: .88rem;
            color: #c0392b;
            margin-bottom: 16px;
        }

        @media (max-width: 991px) {
            .auth-wrapper { flex-direction: column; }
            .auth-side { padding: 40px 30px; }
            .auth-side .auth-hero h1 { font-size: 1.6rem; }
            .auth-features { display: none; }
            .auth-form-panel { padding: 40px 24px; }
            .back-home { top: 14px; right: 14px; }
        }
    </style>
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

<script>
document.querySelectorAll('.toggle-pw').forEach(btn => {
    btn.addEventListener('click', () => {
        const input = btn.parentElement.querySelector('input');
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
});
</script>
</body>
</html>
