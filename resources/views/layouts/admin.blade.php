<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        /* ===================== */
        /* SIDEBAR */
        /* ===================== */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .nav-link {
            color: #555;
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .nav-link:hover {
            background: #f0f3ff;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: white;
        }

        .sidebar img {
            border-radius: 8px;
        }

        body.dark-mode .sidebar img {
            filter: brightness(1.2);
        }

        /* logo text hilang saat collapse */
        .sidebar.collapsed span {
            display: none;
        }

        /* logo tetap center */
        .sidebar.collapsed img {
            margin: auto;
            display: block;
        }

        /* hide text */
        .sidebar.collapsed h5,
        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
        }

        /* ===================== */
        /* NAVBAR */
        /* ===================== */
        .navbar-custom {
            background: white;
            padding: 15px 25px;
            border-bottom: 1px solid #eee;
        }

        .content {
            padding: 20px;
        }

        /* ===================== */
        /* DARK MODE */
        /* ===================== */

        body.dark-mode {
            background: #121212;
            color: #e4e6eb;
        }

        body.dark-mode .sidebar {
            background: #1e1e2f;
        }

        body.dark-mode .navbar-custom {
            background: #1e1e2f;
            border-color: #333;
        }

        body.dark-mode .nav-link {
            color: #bbb;
        }

        body.dark-mode .nav-link:hover {
            background: #2a2d3e;
        }

        body.dark-mode .nav-link.active {
            background: linear-gradient(135deg, #4e73df, #6f42c1);
            color: white;
        }

        body.dark-mode .card {
            background: #1e1e2f;
            color: white;
        }

        body.dark-mode .text-muted {
            color: #aaa !important;
        }

        /* divider */
        .divider {
            width: 1px;
            height: 30px;
            background: #ddd;
        }

        /* dark mode */
        body.dark-mode .divider {
            background: #444;
        }

        /* ===================== */
        /* DARK BUTTON */
        /* ===================== */
        #darkToggle {
            background: #f1f3f5;
            color: #000;
            border-radius: 10px;
            padding: 6px 10px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode #darkToggle {
            background: #3a3f5c;
            color: #fff;
            border: 1px solid #555;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
        }

        /* ===================== */
        /* DROPDOWN DARK */
        /* ===================== */
        body.dark-mode .dropdown-menu {
            background: #1e1e2f;
            color: #fff;
            border: 1px solid #333;
            border-radius: 12px;
        }

        body.dark-mode .dropdown-item {
            color: #ddd;
        }

        body.dark-mode .dropdown-item:hover {
            background: #2a2d3e;
        }

        body.dark-mode .dropdown-divider {
            border-color: #333;
        }
    </style>
</head>

<body>

    <div class="d-flex">

        <!-- SIDEBAR -->
        <div class="sidebar p-3">

            <div class="d-flex align-items-center gap-2 mb-4">
                <img src="{{ asset('images/icon-logo.png') }}" alt="logo" style="width:35px;">
                <span class="fw-bold">Portal Polibatam</span>
            </div>

            <ul class="nav flex-column">

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="nav-link">
                        <i class="bi bi-box"></i>
                        <span>Kelola Layanan</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="nav-link">
                        <i class="bi bi-people"></i>
                        <span>Kelola Pengguna</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="nav-link">
                        <i class="bi bi-link-45deg"></i>
                        <span>Custom Links</span>
                    </a>
                </li>
            </ul>

        </div>

        <!-- MAIN -->
        <div class="flex-grow-1">

            <!-- NAVBAR -->
            <div class="navbar-custom d-flex justify-content-between align-items-center">

                <i id="menuToggle" class="bi bi-list fs-4" style="cursor:pointer;"></i>

                <div class="d-flex align-items-center gap-3">

                    <button id="darkToggle" class="btn border-0">
                        <i class="bi bi-moon"></i>
                    </button>
                    <div class="divider"></div>
                    <div class="dropdown">

                        <div class="d-flex align-items-center gap-2" data-bs-toggle="dropdown" style="cursor:pointer;">
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                                style="width:35px;height:35px;">
                                {{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}
                            </div>
                            <span>{{ Auth::user()->username ?? 'admin' }}</span>
                        </div>

                        <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0 mt-2" style="width:220px;">

                            <div class="p-3 border-bottom">
                                <strong>{{ Auth::user()->username ?? 'admin' }}</strong><br>
                                <small class="text-muted">{{ ucfirst(Auth::user()->role ?? 'Admin') }}</small>
                            </div>

                            <a href="#" class="dropdown-item py-2">
                                Profil Saya
                            </a>

                            <div class="dropdown-divider"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger py-2">
                                    Keluar
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="content">
                @yield('content')
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // DARK MODE
        const toggleBtn = document.getElementById('darkToggle');
        const icon = toggleBtn.querySelector('i');

        function setMode(mode) {
            if (mode === 'dark') {
                document.body.classList.add('dark-mode');
                icon.classList.replace('bi-moon', 'bi-sun');
                localStorage.setItem('darkMode', 'enabled');
            } else {
                document.body.classList.remove('dark-mode');
                icon.classList.replace('bi-sun', 'bi-moon');
                localStorage.setItem('darkMode', 'disabled');
            }
        }

        if (localStorage.getItem('darkMode') === 'enabled') {
            setMode('dark');
        }

        toggleBtn.addEventListener('click', () => {
            document.body.classList.contains('dark-mode') ? setMode('light') : setMode('dark');
        });

        // SIDEBAR TOGGLE
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');

        if (localStorage.getItem('sidebar') === 'collapsed') {
            sidebar.classList.add('collapsed');
        }

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');

            if (sidebar.classList.contains('collapsed')) {
                localStorage.setItem('sidebar', 'collapsed');
            } else {
                localStorage.setItem('sidebar', 'expanded');
            }
        });
    </script>

</body>

</html>