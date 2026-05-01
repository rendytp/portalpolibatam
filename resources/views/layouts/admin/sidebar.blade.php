<div class="sidebar p-3">

    {{-- LOGO --}}
    <div class="d-flex align-items-center gap-2 mb-4">
        <img src="{{ asset('images/icon-logo.png') }}" alt="logo" width="35">
        <span class="fw-bold">Portal Polibatam</span>
    </div>

    {{-- MENU --}}
    <ul class="nav flex-column">

        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.layanan') }}"
                class="nav-link {{ request()->routeIs('admin.layanan*') ? 'active' : '' }}">
                <i class="bi bi-box"></i>
                <span>Kelola Layanan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.users') }}"
                class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Kelola Pengguna</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.links') }}"
                class="nav-link {{ request()->routeIs('admin.links*') ? 'active' : '' }}">
                <i class="bi bi-link-45deg"></i>
                <span>Custom Links</span>
            </a>
        </li>

    </ul>

</div>