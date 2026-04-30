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

        /* Sidebar */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
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

        /* Navbar */
        .navbar-custom {
            background: white;
            padding: 15px 25px;
            border-bottom: 1px solid #eee;
        }

        .content {
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="d-flex">

        <!-- SIDEBAR -->
        <div class="sidebar p-3">

            <h5 class="fw-bold mb-4">
                <i class="bi bi-grid"></i> Portal Polibatam
            </h5>

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="bi bi-box"></i> Kelola Layanan
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="bi bi-people"></i> Kelola Pengguna
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-link-45deg"></i> Custom Links
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-gear"></i> Pengaturan
                    </a>
                </li>

            </ul>

        </div>

        <!-- MAIN -->
        <div class="flex-grow-1">

            <!-- NAVBAR -->
            <div class="navbar-custom d-flex justify-content-between align-items-center">

                <div>
                    <i class="bi bi-list fs-4"></i>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-moon fs-5"></i>

                    <div class="dropdown">

                        <!-- AVATAR -->
                        <div class="d-flex align-items-center gap-2" data-bs-toggle="dropdown" style="cursor:pointer;">
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                                style="width:35px;height:35px;">
                                {{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}
                            </div>
                            <span>{{ Auth::user()->username ?? 'admin' }}</span>
                        </div>

                        <!-- DROPDOWN -->
                        <div class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-0 mt-2" style="width:220px;">

                            <!-- HEADER -->
                            <div class="p-3 border-bottom">
                                <strong>{{ Auth::user()->username ?? 'admin' }}</strong><br>
                                <small class="text-muted">{{ ucfirst(Auth::user()->role ?? 'Admin') }}</small>
                            </div>

                            <!-- MENU -->
                            <a href="#" class="dropdown-item d-flex align-items-center gap-2 py-2">
                                <i class="bi bi-person"></i> Profil Saya
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- LOGOUT -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger d-flex align-items-center gap-2 py-2">
                                    <i class="bi bi-box-arrow-right"></i> Keluar
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

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>