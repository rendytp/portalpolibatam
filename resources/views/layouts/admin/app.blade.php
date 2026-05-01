<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .nav-link {
            color: #555;
            padding: 10px 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .nav-link:hover {
            background: #f0f3ff;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: #fff;
        }

        .sidebar.collapsed span,
        .sidebar.collapsed h5 {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: #fff;
            padding: 15px 25px;
            border-bottom: 1px solid #eee;
        }

        .content {
            padding: 20px;
        }

        /* ===== DARK MODE ===== */
        body.dark-mode {
            background: #121212;
            color: #e4e6eb;
        }

        body.dark-mode .sidebar,
        body.dark-mode .navbar-custom {
            background: #1e1e2f;
        }

        body.dark-mode .nav-link {
            color: #bbb;
        }

        body.dark-mode .nav-link:hover {
            background: #2a2d3e;
        }

        body.dark-mode .nav-link.active {
            background: linear-gradient(135deg, #4e73df, #6f42c1);
        }

        body.dark-mode .card {
            background: #1e1e2f;
        }

        .divider {
            width: 1px;
            height: 30px;
            background: #ddd;
        }

        body.dark-mode .divider {
            background: #444;
        }

        #darkToggle {
            background: #f1f3f5;
            border-radius: 10px;
        }

        body.dark-mode #darkToggle {
            background: #3a3f5c;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="d-flex">

        {{-- SIDEBAR --}}
        @include('layouts.admin.sidebar')

        <div class="flex-grow-1">

            {{-- NAVBAR --}}
            @include('layouts.admin.navbar')

            {{-- CONTENT --}}
            <main class="content">
                @yield('content')
            </main>

        </div>
    </div>

    {{-- SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ===== DARK MODE =====
        const toggleBtn = document.getElementById('darkToggle');
        const icon = toggleBtn?.querySelector('i');

        function setMode(mode) {
            document.body.classList.toggle('dark-mode', mode === 'dark');

            if (icon) {
                icon.classList.toggle('bi-sun', mode === 'dark');
                icon.classList.toggle('bi-moon', mode !== 'dark');
            }

            localStorage.setItem('darkMode', mode);
        }

        if (localStorage.getItem('darkMode') === 'dark') {
            setMode('dark');
        }

        toggleBtn?.addEventListener('click', () => {
            const isDark = document.body.classList.contains('dark-mode');
            setMode(isDark ? 'light' : 'dark');
        });

        // ===== SIDEBAR =====
        const sidebar = document.querySelector('.sidebar');
        const menuToggle = document.getElementById('menuToggle');

        if (localStorage.getItem('sidebar') === 'collapsed') {
            sidebar?.classList.add('collapsed');
        }

        menuToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');

            localStorage.setItem(
                'sidebar',
                sidebar.classList.contains('collapsed') ? 'collapsed' : 'expanded'
            );
        });
    </script>

    @stack('scripts')

</body>

</html>