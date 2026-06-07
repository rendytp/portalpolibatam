@extends('layouts.admin.app')

@section('content')
<style>
    /* Custom style minimalis untuk memastikan input teks serasi di kedua mode */
    .form-group-custom {
        margin-bottom: 1.25rem;
    }

    .form-group-custom label {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control-adaptive {
        background-color: transparent !important;
        color: inherit !important;
        border: 1px solid rgba(128, 128, 128, 0.3) !important;
        border-radius: 0.375rem;
        padding: 0.75rem 1rem;
        width: 100%;
    }

    .form-control-adaptive:focus {
        border-color: #0066ff !important;
        box-shadow: 0 0 0 0.25rem rgba(0, 102, 255, 0.25) !important;
        outline: 0;
    }

    .form-control-adaptive[readonly] {
        background-color: rgba(128, 128, 128, 0.1) !important;
        opacity: 0.6;
        cursor: not-allowed;
    }

    .btn-blue-wide {
        background-color: #0066ff;
        color: #ffffff;
        font-weight: 600;
        border: none;
        border-radius: 0.5rem;
        padding: 0.75rem;
        width: 100%;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-blue-wide:hover {
        background-color: #0052cc;
        color: #ffffff;
    }
</style>

<div class="container-fluid px-3 py-3">

    {{-- BARIS JUDUL HALAMAN --}}
    <div class="d-flex align-items-center gap-3 mb-4 mt-2">
        <div style="background: linear-gradient(135deg, #ff416c, #ff4b2b); width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 14px rgba(255, 65, 108, 0.35);">
            <i class="bi bi-person text-white fs-4"></i>
        </div>
        <div>
            <h2 class="m-0 p-0 fw-bold fs-3">Profil Saya</h2>
            <p class="text-muted m-0" style="font-size: 0.85rem;">Kelola informasi akun dan keamanan Anda</p>
        </div>
    </div>

    {{-- ALERT NOTIFIKASI SYSTEM --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 text-white shadow-sm" style="background-color: #10b981;" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 text-white shadow-sm" style="background-color: #ef4444;" role="alert">
        <ul class="mb-0 text-white">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12 col-lg-9 col-xl-8">

            {{-- SEKSI 1: INFORMASI PROFIL (Menggunakan utility classes otomatis) --}}
            <div class="card border-0 rounded-3 p-4 mb-4 bg-body-tertiary text-body shadow-sm">
                <h4 class="mb-4 fw-bold fs-5">Informasi Profil</h4>

                <form action="{{ route('admin.profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group-custom">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control-adaptive" value="{{ Auth::user()->username ?? 'ren' }}" required>
                    </div>

                    <div class="form-group-custom">
                        <label>Role / Jabatan</label>
                        <input type="text" class="form-control-adaptive text-capitalize" value="{{ Auth::user()->role ?? 'Admin' }}" readonly>
                    </div>

                    <button type="submit" class="btn-blue-wide mt-2">Simpan Perubahan Profil</button>
                </form>
            </div>

            {{-- SEKSI 2: UBAH PASSWORD (Menggunakan utility classes otomatis) --}}
            <div class="card border-0 rounded-3 p-4 mb-4 bg-body-tertiary text-body shadow-sm">
                <h4 class="mb-4 fw-bold fs-5">Ubah Password</h4>

                <form action="{{ route('admin.profil.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group-custom">
                        <label>Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-control-adaptive" placeholder="Masukkan password saat ini" required>
                    </div>

                    <div class="form-group-custom">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control-adaptive" placeholder="Minimal 6 karakter" required>
                    </div>

                    <div class="form-group-custom">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control-adaptive" placeholder="Ulangi password baru" required>
                    </div>

                    <button type="submit" class="btn-blue-wide mt-2">Simpan Password Baru</button>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection