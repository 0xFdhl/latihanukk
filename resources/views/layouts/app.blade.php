<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="dark">

    <title>@yield('title', 'Dashboard') — Sistem Inventaris</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            --bg: #0c0c0e;
            --bg-surface: #131315;
            --bg-elevated: #1a1a1d;
            --bg-input: #0e0e10;
            --text: #f2f2f2;
            --text-secondary: #c7c7cc;
            --text-muted: #8e8e95;
            --border: #26262a;
            --border-strong: #3a3a40;
            --accent: #ffffff;
            --blue: #409cff;
            --green: #30d158;
            --amber: #ff9f0a;
            --red: #ff453a;
            --sidebar-w: 248px;
            --mono: ui-monospace, "JetBrains Mono", "Cascadia Code", "SF Mono", Consolas, Menlo, monospace;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--mono);
            font-size: 13.5px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        a { color: var(--text); text-decoration: none; }

        ::selection { background: var(--accent); color: #000; }

        /* subtle grid backdrop */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 48px 48px;
            opacity: .16;
        }

        /* ============ SIDEBAR ============ */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--bg-surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform .25s ease;
        }

        .sidebar-brand {
            padding: 20px 18px;
            border-bottom: 1px solid var(--border);
        }

        .brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: .5px;
        }

        .brand-mark .glyph {
            width: 26px; height: 26px;
            border: 1px solid var(--border-strong);
            background: var(--bg-elevated);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
            font-size: 13px;
        }

        .brand-sub {
            margin-top: 6px;
            font-size: 10.5px;
            color: var(--text-muted);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .sidebar-nav { padding: 14px 10px; flex: 1; overflow-y: auto; }

        .nav-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-muted);
            padding: 14px 10px 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            margin-bottom: 2px;
            color: var(--text-secondary);
            border: 1px solid transparent;
            font-size: 13px;
            transition: all .15s ease;
        }

        .nav-link i { font-size: 14px; color: var(--text-muted); transition: color .15s; }
        .nav-link .count { margin-left: auto; font-size: 10.5px; color: var(--text-muted); }

        .nav-link:hover {
            background: var(--bg-elevated);
            color: var(--text);
        }
        .nav-link:hover i { color: var(--text); }

        .nav-link.active {
            background: var(--accent);
            color: #000;
            font-weight: 700;
        }
        .nav-link.active i { color: #000; }

        .sidebar-foot {
            padding: 14px 18px;
            border-top: 1px solid var(--border);
            font-size: 10.5px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-dot {
            width: 7px; height: 7px;
            background: var(--green);
            display: inline-block;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .35; }
        }

        /* ============ MAIN ============ */
        .main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }

        /* ============ TOPBAR ============ */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 14px 28px;
            border-bottom: 1px solid var(--border);
            background: color-mix(in srgb, var(--bg) 82%, transparent);
            backdrop-filter: blur(8px);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }

        .crumb {
            font-size: 12.5px;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .crumb .sep { color: var(--border-strong); margin: 0 6px; }
        .crumb .current { color: var(--text); font-weight: 700; }

        .topbar-right { display: flex; align-items: center; gap: 18px; }

        .topbar-clock {
            font-size: 11.5px;
            color: var(--text-muted);
            letter-spacing: .5px;
        }

        .admin-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid var(--border);
            background: var(--bg-surface);
            padding: 6px 12px 6px 8px;
            font-size: 11.5px;
        }

        .admin-avatar {
            width: 24px; height: 24px;
            background: var(--accent);
            color: #000;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 11px;
        }

        .admin-chip .role { color: var(--text-muted); font-size: 10px; display: block; line-height: 1.2; }

        .icon-btn {
            display: none;
            background: none;
            border: 1px solid var(--border-strong);
            color: var(--text);
            width: 34px; height: 34px;
            cursor: pointer;
            font-size: 16px;
            align-items: center;
            justify-content: center;
        }

        /* ============ CONTENT ============ */
        .content { padding: 32px 28px; flex: 1; width: 100%; max-width: 1200px; margin: 0 auto; }

        .page-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 26px;
        }

        .eyebrow {
            font-size: 10.5px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .page-title {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -.5px;
            margin: 0;
            line-height: 1.2;
        }

        .page-desc { color: var(--text-muted); font-size: 12.5px; margin-top: 4px; }

        /* ============ CARDS / PANELS ============ */
        .panel {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            margin-bottom: 20px;
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 18px;
            border-bottom: 1px solid var(--border);
        }

        .panel-title {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .panel-title .bracket { color: var(--text-muted); font-weight: 400; }

        .panel-body { padding: 18px; }
        .panel-body.flush { padding: 0; }

        /* ============ STATS ============ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }

        .stat {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            padding: 16px 18px;
            position: relative;
            transition: border-color .15s;
        }
        .stat:hover { border-color: var(--border-strong); }

        .stat-idx {
            position: absolute;
            top: 12px; right: 14px;
            font-size: 10px;
            color: var(--text-muted);
            letter-spacing: 1px;
        }

        .stat-label {
            font-size: 10.5px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -.5px;
            line-height: 1.1;
        }
        .stat-value small { font-size: 13px; color: var(--text-muted); font-weight: 400; }

        .stat-foot {
            margin-top: 10px;
            font-size: 11px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .stat-foot .up { color: var(--green); }
        .stat-foot .warn { color: var(--amber); }

        /* ============ BUTTONS ============ */
        .btn-x {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 16px;
            font-family: var(--mono);
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid var(--border-strong);
            background: var(--bg-elevated);
            color: var(--text);
            transition: all .15s ease;
            white-space: nowrap;
        }
        .btn-x:hover { background: #222226; border-color: #4a4a52; }

        .btn-x.primary {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
        }
        .btn-x.primary:hover { background: #d9d9d9; border-color: #d9d9d9; }

        .btn-x.ghost { background: transparent; }
        .btn-x.ghost:hover { background: var(--bg-elevated); }

        .btn-x.danger { color: var(--red); border-color: color-mix(in srgb, var(--red) 40%, var(--border-strong)); background: transparent; }
        .btn-x.danger:hover { background: color-mix(in srgb, var(--red) 14%, transparent); border-color: var(--red); }

        .btn-x.sm { padding: 5px 10px; font-size: 11.5px; }
        .btn-x.icon { padding: 6px 9px; }

        /* ============ FORMS ============ */
        .field { margin-bottom: 18px; }

        .field label {
            display: block;
            font-size: 10.5px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            margin-bottom: 7px;
        }
        .field label .req { color: var(--red); }

        .input, .select, .textarea {
            width: 100%;
            background: var(--bg-input);
            border: 1px solid var(--border-strong);
            color: var(--text);
            font-family: var(--mono);
            font-size: 13px;
            padding: 10px 12px;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
        }

        .input::placeholder { color: #55555c; }
        .input:focus, .select:focus, .textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent) 14%, transparent);
        }

        .select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%238e8e95' stroke-width='1.5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 34px;
            cursor: pointer;
        }

        .input.invalid, .select.invalid { border-color: var(--red); }
        .field-error {
            margin-top: 6px;
            font-size: 11.5px;
            color: var(--red);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px 22px;
        }
        .form-grid .full { grid-column: 1 / -1; }

        .form-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 22px 0;
        }

        .form-foot { display: flex; gap: 10px; flex-wrap: wrap; }

        /* ============ FILTER BAR ============ */
        .filter-bar {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            padding: 14px 18px;
            border-bottom: 1px solid var(--border);
        }
        .filter-bar .input, .filter-bar .select { width: auto; min-width: 180px; flex: 1; }
        .filter-bar .select { min-width: 160px; flex: 0 1 200px; }

        /* ============ TABLES ============ */
        .table-wrap { overflow-x: auto; }

        table.data {
            width: 100%;
            border-collapse: collapse;
            font-size: 12.5px;
        }

        table.data th {
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            font-weight: 700;
            padding: 12px 18px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        table.data td {
            padding: 13px 18px;
            border-bottom: 1px solid var(--border);
            color: var(--text-secondary);
            vertical-align: middle;
        }

        table.data tr:last-child td { border-bottom: none; }
        table.data tbody tr { transition: background .12s; }
        table.data tbody tr:hover { background: var(--bg-elevated); }

        table.data .strong { color: var(--text); font-weight: 700; }
        table.data .mono-dim { color: var(--text-muted); }
        table.data td.num { font-variant-numeric: tabular-nums; }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid var(--border-strong);
            background: var(--bg-elevated);
            color: var(--text-secondary);
            padding: 3px 9px;
            font-size: 11px;
            white-space: nowrap;
        }
        .chip i { font-size: 10px; color: var(--text-muted); }

        .chip.ok { color: var(--green); border-color: color-mix(in srgb, var(--green) 35%, var(--border)); }
        .chip.low { color: var(--amber); border-color: color-mix(in srgb, var(--amber) 35%, var(--border)); }
        .chip.out { color: var(--red); border-color: color-mix(in srgb, var(--red) 35%, var(--border)); }

        .row-actions { display: flex; gap: 6px; align-items: center; }
        .row-actions form { display: inline; }

        /* ============ EMPTY STATE ============ */
        .empty {
            text-align: center;
            padding: 52px 20px;
            color: var(--text-muted);
        }
        .empty i { font-size: 26px; opacity: .5; display: block; margin-bottom: 12px; }
        .empty .cmd { font-size: 11.5px; color: var(--text-muted); }
        .empty .cmd .prompt { color: var(--green); }

        /* ============ ALERTS ============ */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 16px;
            margin-bottom: 18px;
            font-size: 12.5px;
            border: 1px solid;
        }
        .alert i { margin-top: 2px; }

        .alert.success {
            color: var(--green);
            border-color: color-mix(in srgb, var(--green) 40%, var(--border));
            background: color-mix(in srgb, var(--green) 8%, var(--bg-surface));
        }

        .alert.error {
            color: var(--red);
            border-color: color-mix(in srgb, var(--red) 40%, var(--border));
            background: color-mix(in srgb, var(--red) 8%, var(--bg-surface));
        }

        .alert ul { margin: 4px 0 0; padding-left: 16px; }
        .alert .close {
            margin-left: auto;
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            font-size: 14px;
            opacity: .7;
        }
        .alert .close:hover { opacity: 1; }

        /* ============ DETAIL (SHOW) ============ */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-top: 1px solid var(--border);
        }

        .detail-item {
            padding: 16px 18px;
            border-bottom: 1px solid var(--border);
        }
        .detail-item:nth-child(odd) { border-right: 1px solid var(--border); }

        .detail-item dt {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .detail-item dd {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
        }
        .detail-item dd.dim { color: var(--text-secondary); font-weight: 400; }

        /* ============ PROGRESS (dashboard) ============ */
        .bar-row { margin-bottom: 16px; }
        .bar-row:last-child { margin-bottom: 0; }

        .bar-meta {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 7px;
        }
        .bar-meta .val { color: var(--text-muted); font-variant-numeric: tabular-nums; }

        .bar {
            height: 8px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .bar > span {
            display: block;
            height: 100%;
            background: var(--accent);
            transition: width .6s ease;
        }
        .bar > span.tinted { background: var(--blue); }

        /* ============ SEARCH ============ */
        .search-wrap { position: relative; }
        .search-wrap i {
            position: absolute;
            left: 11px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 12px;
            pointer-events: none;
        }
        .search-wrap .input { padding-left: 32px; }

        kbd.k {
            font-family: var(--mono);
            font-size: 10px;
            border: 1px solid var(--border-strong);
            background: var(--bg-elevated);
            color: var(--text-muted);
            padding: 1px 5px;
        }

        /* ============ PAGINATION ============ */
        .pagination { display: flex; gap: 6px; flex-wrap: wrap; align-items: center; }
        .pagination .page-info { font-size: 11.5px; color: var(--text-muted); margin-right: 6px; }

        .page-btn {
            min-width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 8px;
            border: 1px solid var(--border-strong);
            background: var(--bg-elevated);
            color: var(--text-secondary);
            font-size: 12px;
            font-family: var(--mono);
            transition: all .15s;
        }
        .page-btn:hover { color: var(--text); border-color: #4a4a52; }
        .page-btn[aria-current="page"], .page-btn.active {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
            font-weight: 700;
        }
        .page-btn.disabled { opacity: .35; pointer-events: none; }

        /* ============ FOOTER ============ */
        .site-foot {
            border-top: 1px solid var(--border);
            padding: 18px 28px;
            font-size: 11px;
            color: var(--text-muted);
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        .site-foot .bracket { color: var(--border-strong); }

        /* ============ RESPONSIVE ============ */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.6);
            z-index: 90;
        }

        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 860px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .icon-btn { display: inline-flex; }
            .overlay.show { display: block; }
            .topbar { padding: 12px 16px; }
            .content { padding: 22px 16px; }
            .site-foot { padding: 16px; }
            .form-grid, .detail-grid { grid-template-columns: 1fr; }
            .detail-item:nth-child(odd) { border-right: none; }
            .page-title { font-size: 21px; }
            .topbar-clock { display: none; }
        }

        @media (max-width: 560px) {
            .stats-grid { grid-template-columns: 1fr; }
        }

        /* ============ MISC ============ */
        .flex-between { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .text-muted-c { color: var(--text-muted); }
        hr.sep { border: none; border-top: 1px solid var(--border); margin: 20px 0; }
    </style>

    @stack('styles')
</head>

<body>

    <!-- OVERLAY (mobile) -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-brand">
            <div class="brand-mark">
                <span class="glyph">&gt;_</span>
                SISTEM&nbsp;INVENTARIS
            </div>
            <div class="brand-sub">Warehouse / v1.0</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">// Menu Utama</div>

            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                Dashboard
            </a>

            <a href="{{ route('products.index') }}"
               class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="bi bi-box"></i>
                Data Barang
            </a>

            <a href="{{ route('categories.index') }}"
               class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i>
                Kategori Barang
            </a>
        </nav>

        <div class="sidebar-foot">
            <span class="status-dot"></span>
            <span>[ SYSTEM: ONLINE ]</span>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="topbar-left">
                <button class="icon-btn" onclick="toggleSidebar()" aria-label="Menu">
                    <i class="bi bi-list"></i>
                </button>
                <div class="crumb">
                    ~<span class="sep">/</span>inventaris<span class="sep">/</span><span class="current">@yield('crumb', 'dashboard')</span>
                </div>
            </div>
            <div class="topbar-right">
                <span class="topbar-clock" id="clock">--:--:--</span>
                <div class="admin-chip">
                    <span class="admin-avatar">A</span>
                    <div>
                        <strong>Administrator</strong>
                        <span class="role">Admin Gudang</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="content">

            <!-- NOTIFIKASI -->
            @if(session('success'))
                <div class="alert success">
                    <i class="bi bi-check-circle"></i>
                    <span>{{ session('success') }}</span>
                    <button class="close" onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert error">
                    <i class="bi bi-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                    <button class="close" onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    <i class="bi bi-exclamation-circle"></i>
                    <div>
                        <strong>Terjadi kesalahan!</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button class="close" onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="site-foot">
            <span><span class="bracket">[</span> {{ date('Y') }} Sistem Manajemen Inventaris Barang <span class="bracket">]</span></span>
            <span>UKK &middot; All Rights Reserved</span>
        </footer>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('show');
        }

        // jam realtime di topbar
        (function () {
            var el = document.getElementById('clock');
            if (!el) return;
            function tick() {
                var d = new Date();
                el.textContent = d.toLocaleTimeString('id-ID', { hour12: false }) + ' WIB';
            }
            tick();
            setInterval(tick, 1000);
        })();

        // shortcut "/" untuk fokus ke kolom pencarian
        document.addEventListener('keydown', function (e) {
            if (e.key === '/' && !/INPUT|TEXTAREA|SELECT/.test(document.activeElement.tagName)) {
                var s = document.querySelector('.search-wrap input');
                if (s) { e.preventDefault(); s.focus(); }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
