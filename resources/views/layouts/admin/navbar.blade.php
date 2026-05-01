<div class="navbar-custom d-flex justify-content-between align-items-center">

    {{-- TOGGLE SIDEBAR --}}
    <i id="menuToggle" class="bi bi-list fs-4" style="cursor:pointer;"></i>

    <div class="d-flex align-items-center gap-3">

        {{-- DARK MODE --}}
        <button id="darkToggle" class="btn border-0">
            <i class="bi bi-moon"></i>
        </button>

        <div class="divider"></div>

        {{-- USER DROPDOWN --}}
        <div class="dropdown">

            <div class="d-flex align-items-center gap-2"
                data-bs-toggle="dropdown"
                style="cursor:pointer;">

                {{-- AVATAR --}}
                <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                    style="width:35px;height:35px;">
                    {{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}
                </div>

                {{-- USERNAME --}}
                <span>{{ Auth::user()->username ?? 'admin' }}</span>
            </div>

            {{-- DROPDOWN MENU --}}
            <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0 mt-2"
                style="width:220px;">

                <div class="p-3 border-bottom">
                    <strong>{{ Auth::user()->username ?? 'admin' }}</strong><br>
                    <small class="text-muted">
                        {{ ucfirst(Auth::user()->role ?? 'Admin') }}
                    </small>
                </div>

                <a href="#" class="dropdown-item py-2">
                    <i class="bi bi-person me-2"></i> Profil Saya
                </a>

                <div class="dropdown-divider"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger py-2">
                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>