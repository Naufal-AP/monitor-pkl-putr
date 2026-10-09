<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Monitor PKL PUTR')</title>

    <style>
        :root {
            --putr-navy: #102A43;
            --putr-blue: #1769AA;
            --putr-blue-dark: #0F4C81;
            --putr-yellow: #F4C430;

            --bg: #F3F6F9;
            --surface: #FFFFFF;

            --text: #172B3A;
            --text-secondary: #52606D;
            --text-muted: #829AB1;

            --border: #D9E2EC;

            --success: #18864B;
            --success-bg: #EAF7EF;

            --danger: #C9372C;
            --danger-bg: #FDEDEC;

            --warning: #A66A00;
            --warning-bg: #FFF6DB;

            --nav-height: 70px;
        }


        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        html {
            background: #E7EDF3;
        }


        body {
            min-height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    #E7EDF3 0%,
                    #F3F6F9 220px
                );

            color: var(--text);

            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Arial,
                sans-serif;

            font-size: 14px;
            line-height: 1.5;

            -webkit-font-smoothing: antialiased;
        }


        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }


        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }


        /* ==========================================
           APP SHELL
        ========================================== */

        .app {
            position: relative;

            width: 100%;
            max-width: 430px;
            min-height: 100vh;

            margin: 0 auto;

            background: var(--bg);

            overflow-x: hidden;

            box-shadow:
                0 0 35px rgba(16, 42, 67, .08);
        }


        .content {
            min-height: 100vh;

            padding: 20px;

            padding-bottom: calc(
                var(--nav-height) + 28px
            );
        }


        /* ==========================================
           TOP BRAND
        ========================================== */

        .page-brand {
            display: flex;
            align-items: center;

            gap: 10px;

            margin-bottom: 22px;
        }


        .brand-mark {
            position: relative;

            width: 38px;
            height: 38px;

            flex: 0 0 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--putr-navy);

            border-radius: 9px;

            color: var(--putr-yellow);

            box-shadow:
                0 4px 10px rgba(16, 42, 67, .12);
        }


        .brand-mark::after {
            content: "";

            position: absolute;

            right: -2px;
            bottom: -2px;

            width: 9px;
            height: 9px;

            background: var(--putr-yellow);

            border-radius: 50%;

            border: 2px solid var(--bg);
        }


        .brand-mark svg {
            width: 20px;
            height: 20px;
        }


        .brand-copy {
            min-width: 0;
        }


        .brand-copy strong {
            display: block;

            color: var(--putr-navy);

            font-size: 12px;
            font-weight: 750;

            letter-spacing: .01em;
        }


        .brand-copy span {
            display: block;

            margin-top: 1px;

            color: var(--text-muted);

            font-size: 9px;
        }


        /* ==========================================
           SECTION
        ========================================== */

        .section-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            gap: 12px;

            margin-bottom: 11px;
        }


        .section-heading h2 {
            color: var(--text);

            font-size: 16px;
            line-height: 1.25;

            font-weight: 700;
        }


        .section-heading p {
            margin-top: 3px;

            color: var(--text-muted);

            font-size: 10px;
        }


        .section-heading > a {
            color: var(--putr-blue);

            font-size: 10px;
            font-weight: 650;

            text-decoration: none;

            white-space: nowrap;
        }


        /* ==========================================
           BUTTONS
        ========================================== */

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            min-height: 38px;

            padding: 0 14px;

            border: 0;
            border-radius: 8px;

            background: var(--putr-navy);
            color: #fff;

            font-size: 12px;
            font-weight: 650;

            text-decoration: none;

            cursor: pointer;

            transition:
                background .15s ease,
                transform .15s ease;
        }


        .btn-primary:hover {
            background: var(--putr-blue-dark);
        }


        .btn-primary:active {
            transform: translateY(1px);
        }


        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 36px;

            padding: 0 13px;

            border: 1px solid var(--border);
            border-radius: 8px;

            background: #fff;
            color: var(--text-secondary);

            font-size: 11px;
            font-weight: 600;

            text-decoration: none;

            cursor: pointer;
        }


        .btn-secondary:hover {
            background: #F8FAFC;
            border-color: #BCCCDC;
        }


        .finish-btn {
            min-height: 36px;

            padding: 0 13px;

            border: 1px solid #B7E3C8;
            border-radius: 8px;

            background: var(--success-bg);
            color: var(--success);

            font-size: 11px;
            font-weight: 650;

            cursor: pointer;
        }


        /* ==========================================
           ACTION BUTTON GROUP
        ========================================== */

        .action-buttons {
            display: flex;

            gap: 8px;

            margin-top: 13px;
        }


        .action-buttons form {
            margin: 0;
        }


        /* ==========================================
           STATUS
        ========================================== */

        .status-badge {
            display: inline-flex;
            align-items: center;

            gap: 5px;

            padding: 5px 8px;

            border-radius: 6px;

            font-size: 9px;
            font-weight: 700;
        }


        .status-badge::before {
            content: "";

            width: 5px;
            height: 5px;

            border-radius: 50%;
        }


        .status-badge.active {
            background: var(--success-bg);
            color: var(--success);
        }


        .status-badge.active::before {
            background: var(--success);
        }


        .status-badge.completed {
            background: #EEF2F6;
            color: #52606D;
        }


        .status-badge.completed::before {
            background: #829AB1;
        }


        /* ==========================================
           DETAIL CARD
        ========================================== */

        .detail-card {
            background: var(--surface);

            border: 1px solid var(--border);
            border-radius: 12px;

            padding: 20px;

            box-shadow:
                0 4px 12px rgba(16, 42, 67, .035);
        }


        .detail-avatar {
            width: 54px;
            height: 54px;

            margin: 0 auto 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: #EAF2F9;
            color: var(--putr-blue);

            font-size: 19px;
            font-weight: 750;
        }


        .detail-card h2 {
            margin-bottom: 7px;

            color: var(--text);

            font-size: 18px;
            line-height: 1.3;
        }


        .detail-list {
            margin-top: 20px;

            border-top: 1px solid var(--border);

            text-align: left;
        }


        .detail-item {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 15px;

            padding: 12px 0;

            border-bottom: 1px solid var(--border);
        }


        .detail-item span {
            color: var(--text-muted);

            font-size: 11px;
        }


        .detail-item strong {
            max-width: 62%;

            color: var(--text);

            font-size: 11px;
            font-weight: 650;

            text-align: right;
        }


        .detail-actions {
            display: flex;

            gap: 8px;

            margin-top: 18px;
        }


        .detail-actions a {
            flex: 1;
        }


        /* ==========================================
           FORM
        ========================================== */

        .form-card {
            padding: 18px;

            background: #fff;

            border: 1px solid var(--border);
            border-radius: 12px;

            box-shadow:
                0 4px 12px rgba(16, 42, 67, .035);
        }


        .form-group {
            margin-bottom: 15px;
        }


        .form-group:last-child {
            margin-bottom: 0;
        }


        .form-group label {
            display: block;

            margin-bottom: 6px;

            color: var(--text);

            font-size: 11px;
            font-weight: 650;
        }


        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;

            min-height: 40px;

            padding: 9px 11px;

            border: 1px solid var(--border);
            border-radius: 8px;

            background: #fff;
            color: var(--text);

            font-size: 12px;

            outline: none;

            transition:
                border-color .15s ease,
                box-shadow .15s ease;
        }


        .form-group textarea {
            min-height: 90px;

            resize: vertical;
        }


        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #9FB3C8;
        }


        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--putr-blue);

            box-shadow:
                0 0 0 3px rgba(23, 105, 170, .08);
        }


        .form-actions {
            display: flex;

            gap: 8px;

            margin-top: 18px;
        }


        .form-actions > * {
            flex: 1;
        }


        /* ==========================================
           SEARCH
        ========================================== */

        .search-form {
            display: flex;

            gap: 8px;

            margin-bottom: 16px;
        }


        .search-form input {
            flex: 1;

            width: 100%;

            min-height: 40px;

            padding: 9px 12px;

            border: 1px solid var(--border);
            border-radius: 8px;

            background: #fff;

            color: var(--text);

            font-size: 12px;

            outline: none;
        }


        .search-form input:focus {
            border-color: var(--putr-blue);

            box-shadow:
                0 0 0 3px rgba(23, 105, 170, .08);
        }


        .search-form button {
            width: 40px;
            min-width: 40px;

            border: 0;
            border-radius: 8px;

            background: var(--putr-navy);
            color: #fff;

            cursor: pointer;
        }


        .search-form button svg {
            width: 16px;
            height: 16px;
        }


        /* ==========================================
           BOTTOM NAVIGATION
        ========================================== */

        .bottom-nav {
            position: fixed;

            left: 50%;
            bottom: 0;

            transform: translateX(-50%);

            width: 100%;
            max-width: 430px;

            height: var(--nav-height);

            display: grid;
            grid-template-columns: repeat(4, 1fr);

            background: rgba(255,255,255,.97);

            border-top: 1px solid var(--border);

            box-shadow:
                0 -4px 18px rgba(16,42,67,.055);

            z-index: 100;
        }


        .nav-item {
            position: relative;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            gap: 4px;

            color: #829AB1;

            text-decoration: none;

            font-size: 9px;
            font-weight: 550;

            transition:
                color .15s ease,
                background .15s ease;
        }


        .nav-item svg {
            width: 19px;
            height: 19px;

            stroke: currentColor;
        }


        .nav-item.active {
            color: var(--putr-blue);
            font-weight: 700;

            background:
                linear-gradient(
                    180deg,
                    rgba(23,105,170,.045),
                    transparent
                );
        }


        .nav-item.active::before {
            content: "";

            position: absolute;

            top: 0;
            left: 50%;

            transform: translateX(-50%);

            width: 32px;
            height: 3px;

            background: var(--putr-yellow);

            border-radius: 0 0 3px 3px;
        }


        /* ==========================================
           ALERT
        ========================================== */

        .alert {
            display: flex;
            align-items: flex-start;

            gap: 9px;

            padding: 11px 12px;

            margin-bottom: 15px;

            border-radius: 8px;

            font-size: 11px;
        }


        .alert.success {
            border: 1px solid #C6E8D1;

            background: var(--success-bg);
            color: #176B3A;
        }


        .alert.error {
            border: 1px solid #F2C4C0;

            background: var(--danger-bg);
            color: #A32922;
        }


        /* ==========================================
           EMPTY STATE
        ========================================== */

        .empty-state {
            padding: 30px 18px;

            text-align: center;

            border: 1px dashed #BCCCDC;
            border-radius: 11px;

            background: rgba(255,255,255,.65);
        }


        .empty-state strong {
            display: block;

            color: var(--text);

            font-size: 12px;
        }


        .empty-state p {
            margin-top: 5px;

            color: var(--text-muted);

            font-size: 10px;
        }


        /* ==========================================
           DESKTOP FRAME
        ========================================== */

        @media (min-width: 431px) {

            body {
                padding: 20px 0;
            }


            .app {
                min-height: calc(100vh - 40px);

                border: 1px solid #D9E2EC;
                border-radius: 12px;

                overflow: hidden;
            }


            .content {
                min-height: calc(100vh - 40px);
            }


            .bottom-nav {
                bottom: 20px;

                border-radius: 0 0 12px 12px;
            }

        }


        /* ==========================================
           SMALL SCREEN
        ========================================== */

        @media (max-width: 360px) {

            .content {
                padding-left: 16px;
                padding-right: 16px;
            }

            .brand-copy strong {
                font-size: 11px;
            }

        }

    </style>

    @stack('styles')

</head>


<body>

<div class="app">

    <main class="content">

        @yield('content')

    </main>


    <!-- ===============================
         BOTTOM NAVIGATION
    ================================ -->

    <nav class="bottom-nav">

        <!-- BERANDA -->

        <a
            href="{{ url('/') }}"
            class="nav-item {{ request()->is('/') ? 'active' : '' }}"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke-width="1.8"
            >
                <path d="M3 10.5L12 3l9 7.5"/>
                <path d="M5 9.5V21h14V9.5"/>
                <path d="M9 21v-6h6v6"/>
            </svg>

            <span>Beranda</span>

        </a>


        <!-- PKL -->

        <a
            href="{{ route('peserta.index') }}"
            class="nav-item {{
                request()->is('peserta')
                || (
                    request()->is('peserta/*')
                    && !request()->is('peserta/selesai')
                )
                    ? 'active'
                    : ''
            }}"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke-width="1.8"
            >
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>

            <span>PKL</span>

        </a>


        <!-- KUOTA -->

        <a
            href="{{ route('periode.index') }}"
            class="nav-item {{ request()->is('periode*') ? 'active' : '' }}"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke-width="1.8"
            >
                <rect x="3" y="4" width="18" height="17" rx="2"/>
                <path d="M16 2v4"/>
                <path d="M8 2v4"/>
                <path d="M3 10h18"/>
                <path d="M8 14h3"/>
                <path d="M8 17h3"/>
            </svg>

            <span>Kuota</span>

        </a>


        <!-- SELESAI -->

        <a
            href="{{ route('peserta.selesai.list') }}"
            class="nav-item {{ request()->is('peserta/selesai') ? 'active' : '' }}"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke-width="1.8"
            >
                <circle cx="12" cy="12" r="9"/>
                <path d="M8 12l2.5 2.5L16 9"/>
            </svg>

            <span>Selesai</span>

        </a>

    </nav>

</div>


@stack('scripts')

</body>

</html>