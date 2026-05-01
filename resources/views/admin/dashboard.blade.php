@extends('layouts.admin.app')

@section('content')
<div class="container-fluid py-4">

    <!-- TITLE -->
    <div class="mb-4">
        <h2 class="fw-bold">Dashboard Admin</h2>
        <p class="text-muted">Kelola sistem Portal Polibatam</p>
    </div>

    <div class="row g-4">

        <!-- Total Layanan -->
        <div class="col-md-3">
            <div class="card p-4 rounded-4 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="bg-primary text-white p-3 rounded-3">
                        <i class="bi bi-database"></i>
                    </div>
                    <span class="text-success fw-bold">↗</span>
                </div>

                <h3 class="mt-3 fw-bold">{{ $totalLayanan }}</h3>
                <p class="text-muted mb-1">Total Layanan</p>
                <small class="text-success">
                    +{{ $layananBulanIni }} bulan ini
                </small>
            </div>
        </div>

        <!-- Layanan Aktif -->
        <div class="col-md-3">
            <div class="card p-4 rounded-4 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="bg-success text-white p-3 rounded-3">
                        <i class="bi bi-gear"></i>
                    </div>
                    <span class="text-success fw-bold">↗</span>
                </div>

                <h3 class="mt-3 fw-bold">{{ $layananAktif }}</h3>
                <p class="text-muted mb-1">Layanan Aktif</p>
                <small class="text-success">{{ $layananAktif }} aktif</small>
            </div>
        </div>

        <!-- Total Pengguna -->
        <div class="col-md-3">
            <div class="card p-4 rounded-4 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="bg-purple text-white p-3 rounded-3" style="background:#8e44ad;">
                        <i class="bi bi-people"></i>
                    </div>
                    <span class="text-success fw-bold">↗</span>
                </div>

                <h3 class="mt-3 fw-bold">{{ $totalUser }}</h3>
                <p class="text-muted mb-1">Total Pengguna</p>
                <small class="text-success">
                    +{{ $userMingguIni }} minggu ini
                </small>
            </div>
        </div>

        <!-- Pengguna Aktif -->
        <div class="col-md-3">
            <div class="card p-4 rounded-4 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="bg-warning text-white p-3 rounded-3">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <span class="text-success fw-bold">↗</span>
                </div>

                <h3 class="mt-3 fw-bold">{{ $userAktif }}</h3>
                <p class="text-muted mb-1">Pengguna Aktif</p>
                <small class="text-success">
                    {{ $persentaseUser }}% online
                </small>
            </div>
        </div>

    </div>

</div>
@endsection