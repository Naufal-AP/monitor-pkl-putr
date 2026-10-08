<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Monitor PKL PUPR')</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f7f8fa;
            color: #1f2937;
        }

        .app {
            width: 100%;
            max-width: 430px;
            min-height: 100vh;
            margin: auto;
            background: #ffffff;
        }

        .content {
            padding: 20px;
            padding-bottom: 90px;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 430px;
            height: 70px;
            background: white;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .nav-item {
            text-decoration: none;
            color: #9ca3af;
            font-size: 12px;
            text-align: center;
        }

        .nav-item.active {
            color: #2563eb;
        }

        .action-buttons {
    display: flex;
    gap: 8px;
    margin-top: 12px;
}

.action-buttons form {
    margin: 0;
}

.btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 14px;
    border-radius: 10px;
    background: #f1f5f9;
    color: #334155;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
}

.finish-btn {
    border: none;
    padding: 10px 14px;
    border-radius: 10px;
    background: #dcfce7;
    color: #166534;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
}

.detail-card {
    background: white;
    border-radius: 18px;
    padding: 22px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    text-align: center;
}

.detail-avatar {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    margin: 0 auto 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e8f0fe;
    color: #2563eb;
    font-size: 24px;
    font-weight: 700;
}

.detail-card h2 {
    margin: 0 0 8px;
    font-size: 20px;
}

.status-badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    background: #dcfce7;
    color: #166534;
    font-size: 11px;
    font-weight: 700;
}

.detail-list {
    margin-top: 24px;
    text-align: left;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    padding: 13px 0;
    border-bottom: 1px solid #eee;
}

.detail-item span {
    color: #64748b;
    font-size: 13px;
}

.detail-item strong {
    text-align: right;
    font-size: 13px;
    color: #1e293b;
}

.detail-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.detail-actions a {
    flex: 1;
}
    </style>

    @stack('styles')
</head>

<body>

<div class="app">

    <main class="content">
        @yield('content')
    </main>

<nav class="bottom-nav">

    <a href="{{ url('/') }}"
       class="nav-item {{ request()->is('/') ? 'active' : '' }}">
        🏠
        <span>Beranda</span>
    </a>

    <a href="{{ route('peserta.index') }}"
       class="nav-item {{ request()->is('peserta') ? 'active' : '' }}">
        👥
        <span>PKL</span>
    </a>

    <a href="{{ route('periode.index') }}"
       class="nav-item {{ request()->is('periode*') ? 'active' : '' }}">
        📊
        <span>Kuota</span>
    </a>

    <a href="{{ route('peserta.selesai.list') }}"
       class="nav-item {{ request()->is('peserta/selesai') ? 'active' : '' }}">
        ✓
        <span>Selesai</span>
    </a>

</nav>

</div>

@stack('scripts')

</body>
</html>