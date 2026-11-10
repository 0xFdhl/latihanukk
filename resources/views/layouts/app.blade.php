
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') | Sistem Inventaris</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #f1f5f9;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #172554;
            color: white;
            padding: 22px 16px;
            z-index: 1000;
            overflow-y: auto;
            transition: .3s;
        }

        .brand {
            font-size: 21px;
            font-weight: bold;
            padding: 10px;
            margin-bottom: 30px;
        }

        .brand i {
            color: #60a5fa;
        }

        .menu-title {
            color: #94a3b8;
            font-size: 11px;
            font-weight: bold;
            margin: 20px 10px 10px;
            text-transform: uppercase;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            margin-bottom: 6px;
            border-radius: 8px;
            color: #cbd5e1;
            text-decoration: none;
            transition: .2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 250px;
            padding: 25px;
            transition: .3s;
        }

        /* NAVBAR */
        .topbar {
            background: white;
            padding: 16px 22px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
            margin-bottom: 25px;
        }

        .topbar h5 {
            margin: 0;
            font-weight: 600;
        }

        .content-title {
            font-weight: 700;
            color: #1e293b;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        .table th {
            background: #f8fafc;
            color: #475569;
            font-size: 13px;
        }

        .table td {
            font-size: 14px;
            vertical-align: middle;
        }

        .btn {
            border-radius: 7px;
        }

        .alert {
            border-radius: 10px;
        }

        .footer {
            color: #94a3b8;
            font-size: 12px;
            text-align: center;
            padding: 25px 0 10px;
        }

        /* MOBILE */
        .sidebar-toggle {
            display: none;
        }

        @media(max-width: 768px) {

            .sidebar {
                left: -250px;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .sidebar-toggle {
                display: inline-block;
            }
        }
    </style>

    @stack('styles')

</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="brand">
            <i class="bi bi-box-seam"></i>
            INVENTARIS
        </div>

        <div class="menu-title">Menu Utama</div>

        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="{{ route('products.index') }}"
           class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box"></i>
            Data Barang
        </a>

        <a href="{{ route('categories.index') }}"
           class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i>
            Kategori Barang
        </a>

        <div class="menu-title">Informasi</div>

        <a href="#">
            <i class="bi bi-info-circle"></i>
            Tentang Aplikasi
        </a>

    </aside>


    <!-- MAIN -->
    <main class="main-content">

        <!-- TOPBAR -->
        <div class="topbar">

            <div class="d-flex align-items-center gap-3">

                <button class="btn btn-light sidebar-toggle"
                        onclick="toggleSidebar()">
                    <i class="bi bi-list fs-5"></i>
                </button>

                <div>
                    <h5>@yield('title', 'Dashboard')</h5>
                    <small class="text-muted">
                        Sistem Manajemen Inventaris Barang
                    </small>
                </div>

            </div>

            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-circle fs-4 text-primary"></i>

                <div class="d-none d-sm-block">
                    <strong lass="small">Administrator<c/strong>
                    <div class="text-muted" style="font-size:11px">
                        Admin Gudang
                    </div>
                </div>
            </div>

        </div>


        <!-- NOTIFIKASI -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle me-2"></i>
                {{ session('error') }}

                <button type="button" class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- CONTENT -->
        @yield('content')


        <!-- FOOTER -->
        <div class="footer">
            © {{ date('Y') }} Sistem Manajemen Inventaris Barang.
            All Rights Reserved.
        </div>

    </main>


    <!-- JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>

    @stack('scripts')

</body>
</html>
