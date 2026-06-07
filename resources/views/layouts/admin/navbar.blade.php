<div class="navbar-custom d-flex justify-content-between align-items-center">

    {{-- TOGGLE SIDEBAR --}}
    <i id="menuToggle"
        class="bi bi-list fs-4 navbar-icon"
        style="cursor:pointer;">
    </i>

    <div class="d-flex align-items-center gap-3">

        {{-- DARK MODE --}}
        <button id="darkToggle" class="btn border-0">
            <i class="bi bi-moon"></i>
        </button>

        <div class="divider"></div>

        {{-- USER DROPDOWN --}}
        <div class="dropdown">

            <div class="d-flex align-items-center gap-2 navbar-user"
                data-bs-toggle="dropdown"
                style="cursor:pointer;">

                {{-- AVATAR --}}
                <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                    style="width:35px;height:35px;">

                    {{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}

                </div>

                {{-- USERNAME --}}
                <span class="username-text">
                    {{ Auth::user()->username ?? 'Admin' }}
                </span>

                <i class="bi bi-chevron-down small"></i>

            </div>

            {{-- DROPDOWN MENU --}}
            <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0 mt-2 custom-dropdown">

                <div class="p-3 border-bottom">

                    <strong class="dropdown-username">
                        {{ Auth::user()->username ?? 'Admin' }}
                    </strong>

                    <br>

                    <small class="dropdown-role">
                        {{ ucfirst(Auth::user()->role ?? 'admin') }}
                    </small>

                </div>

                <a href="#" class="dropdown-item py-2">
                    <i class="bi bi-person me-2"></i>
                    Profil Saya
                </a>

                <div class="dropdown-divider"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="dropdown-item text-danger py-2">

                        <i class="bi bi-box-arrow-right me-2"></i>
                        Keluar

                    </button>
                </form>

            </div>

        </div>

    </div>

</div>