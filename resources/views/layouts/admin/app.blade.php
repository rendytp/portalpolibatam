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
        /* ========================================
   GLOBAL
======================================== */
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .content {
            padding: 20px;
        }

        /* ========================================
   SIDEBAR
======================================== */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #e5e7eb;
            overflow-x: hidden;
            transition: .3s;
        }

        .sidebar.collapsed {
            width: 75px;
        }

        .sidebar-logo span {
            color: #111827;
            white-space: nowrap;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            margin-bottom: 5px;
            border-radius: 12px;
            color: #4b5563;
            transition: .2s;
        }

        .sidebar .nav-link i {
            min-width: 20px;
        }

        .sidebar .nav-link:hover {
            background: #f3f4f6;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff;
        }

        .sidebar.collapsed span,
        .sidebar.collapsed .sidebar-logo span {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
        }

        /* ========================================
   NAVBAR
======================================== */
        .navbar-custom {
            background: #fff;
            padding: 15px 25px;
            border-bottom: 1px solid #e5e7eb;
        }

        .username-text {
            font-weight: 500;
            color: #111827;
        }

        .divider {
            width: 1px;
            height: 30px;
            background: #ddd;
        }

        #darkToggle {
            background: #f3f4f6;
            border-radius: 10px;
        }

        /* ========================================
   CUSTOM LINK
======================================== */
        .link-title {
            color: #111827;
            font-weight: 600;
        }

        .link-url {
            color: #6b7280;
        }

        .icon-link {
            background: #10b981;
        }

        /* ========================================
   BADGES
======================================== */
        .badge-kategori,
        .badge-status,
        .badge-role {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-kategori {
            background: #dbeafe;
            color: #2563eb;
        }

        .badge-status {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-role {
            background: #f3e8ff;
            color: #9333ea;
        }

        /* ========================================
   DROPDOWN USER
======================================== */
        .dropdown-username {
            color: #111827;
        }

        .dropdown-role {
            color: #6b7280;
        }

        /* ========================================
   DARK MODE - BASE
======================================== */
        body.dark-mode {
            background: #121212;
            color: #fff;
        }

        /* ========================================
   DARK MODE - NAVBAR
======================================== */
        body.dark-mode .navbar-custom {
            background: #1e1e2f;
            border-bottom: 1px solid #32364d;
        }

        body.dark-mode .navbar-icon,
        body.dark-mode .username-text,
        body.dark-mode .sidebar-logo span {
            color: #fff !important;
        }

        body.dark-mode .divider {
            background: #444;
        }

        body.dark-mode #darkToggle {
            background: #32364d;
            color: #fff;
        }

        /* ========================================
   DARK MODE - SIDEBAR
======================================== */
        body.dark-mode .sidebar {
            background: #1e1e2f;
            border-right: 1px solid #32364d;
        }

        body.dark-mode .nav-link {
            color: #d1d5db;
        }

        body.dark-mode .nav-link:hover {
            background: #2d3148;
        }

        body.dark-mode .nav-link.active {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
        }

        /* ========================================
   DARK MODE - TYPOGRAPHY
======================================== */
        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4,
        body.dark-mode h5,
        body.dark-mode h6,
        body.dark-mode strong {
            color: #fff !important;
        }

        body.dark-mode p,
        body.dark-mode span,
        body.dark-mode label,
        body.dark-mode td,
        body.dark-mode th,
        body.dark-mode li {
            color: #e4e6eb !important;
        }

        body.dark-mode .text-muted,
        body.dark-mode .text-muted-small {
            color: #b0b3b8 !important;
        }

        /* ========================================
   DARK MODE - CARD
======================================== */
        body.dark-mode .card,
        body.dark-mode .card-custom,
        body.dark-mode .card-link,
        body.dark-mode .empty-state {
            background: #1e1e2f !important;
            border: 1px solid #32364d !important;
            color: #fff !important;
        }

        body.dark-mode .link-title {
            color: #fff !important;
        }

        body.dark-mode .link-url,
        body.dark-mode .empty-state p {
            color: #b0b3b8 !important;
        }

        body.dark-mode .icon-link {
            background: #059669;
        }

        /* ========================================
   DARK MODE - TABLE
======================================== */
        body.dark-mode .table {
            color: #fff !important;
        }

        body.dark-mode .table thead th {
            background: #252836 !important;
            color: #fff !important;
            border-color: #32364d !important;
        }

        body.dark-mode .table tbody td {
            background: #1e1e2f !important;
            color: #e5e7eb !important;
            border-color: #32364d !important;
        }

        body.dark-mode .table tbody tr:hover td {
            background: #252836 !important;
        }

        /* ========================================
   DARK MODE - FORM
======================================== */
        body.dark-mode .form-control,
        body.dark-mode .form-select,
        body.dark-mode select,
        body.dark-mode textarea {
            background: #2a2d3e !important;
            color: #fff !important;
            border: 1px solid #444 !important;
        }

        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus,
        body.dark-mode select:focus,
        body.dark-mode textarea:focus {
            background: #2a2d3e !important;
            color: #fff !important;
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 .2rem rgba(99, 102, 241, .25);
        }

        body.dark-mode input::placeholder,
        body.dark-mode textarea::placeholder,
        body.dark-mode .form-control::placeholder {
            color: #9ca3af !important;
        }

        body.dark-mode select option {
            background: #1e1e2f;
            color: #fff;
        }

        /* ========================================
   DARK MODE - CHECKBOX
======================================== */
        body.dark-mode .form-check-label {
            color: #fff !important;
        }

        body.dark-mode .form-check-input {
            background: #2a2d3e;
            border-color: #555;
        }

        body.dark-mode .form-check-input:checked {
            background: #6366f1;
            border-color: #6366f1;
        }

        /* ========================================
   DARK MODE - MODAL
======================================== */
        body.dark-mode .modal-content {
            background: #1e1e2f !important;
            color: #fff !important;
            border: 1px solid #32364d;
        }

        body.dark-mode .modal-header,
        body.dark-mode .modal-footer {
            background: #252836 !important;
            border-color: #32364d !important;
        }

        body.dark-mode .modal-title,
        body.dark-mode .modal label {
            color: #fff !important;
        }

        body.dark-mode .btn-close {
            filter: invert(1);
        }

        /* ========================================
   DARK MODE - DROPDOWN
======================================== */
        body.dark-mode .dropdown-menu,
        body.dark-mode .custom-dropdown {
            background: #252836 !important;
            border: 1px solid #32364d !important;
        }

        body.dark-mode .dropdown-item {
            color: #fff !important;
        }

        body.dark-mode .dropdown-item:hover {
            background: #32364d !important;
        }

        body.dark-mode .dropdown-username {
            color: #fff !important;
        }

        body.dark-mode .dropdown-role {
            color: #b0b3b8 !important;
        }

        body.dark-mode .dropdown-divider,
        body.dark-mode .border-bottom {
            border-color: #32364d !important;
        }

        /* ========================================
   DARK MODE - ALERT
======================================== */
        body.dark-mode .alert-success {
            background: #143d2d;
            border-color: #1d5a42;
            color: #c6f6d5;
        }

        /* ========================================
   DARK MODE - LINKS
======================================== */
        body.dark-mode a {
            color: #8ab4ff;
        }

        /* ========================================
   DARK MODE - BADGES
======================================== */
        body.dark-mode .badge-kategori {
            background: rgba(37, 99, 235, .2) !important;
            color: #60a5fa !important;
            border: 1px solid rgba(96, 165, 250, .3);
        }

        body.dark-mode .badge-status {
            background: rgba(22, 163, 74, .2) !important;
            color: #4ade80 !important;
            border: 1px solid rgba(74, 222, 128, .3);
        }

        body.dark-mode .badge-role {
            background: rgba(147, 51, 234, .2) !important;
            color: #c084fc !important;
            border: 1px solid rgba(192, 132, 252, .3);
        }

        body.dark-mode .badge.bg-danger {
            background: rgba(220, 38, 38, .2) !important;
            color: #f87171 !important;
            border: 1px solid rgba(248, 113, 113, .3);
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