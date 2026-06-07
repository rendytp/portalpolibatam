@extends('layouts.admin.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold">Dashboard Admin</h2>
        <p class="text-muted">Kelola sistem Portal Polibatam</p>
    </div>

    <!-- Statistik -->
    <div class="row g-4">

        <!-- Total Layanan -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div class="bg-primary text-white rounded-4 p-3">
                            <i class="bi bi-database fs-4"></i>
                        </div>

                        <span class="text-success fs-5">
                            <i class="bi bi-arrow-up-right"></i>
                        </span>
                    </div>

                    <h1 class="fw-bold mt-4">{{ $totalLayanan }}</h1>

                    <p class="text-muted mb-1">
                        Total Layanan
                    </p>

                    <small class="text-success fw-semibold">
                        +{{ $layananBulanIni }} bulan ini
                    </small>
                </div>
            </div>
        </div>

        <!-- Layanan Aktif -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div class="bg-success text-white rounded-4 p-3">
                            <i class="bi bi-gear fs-4"></i>
                        </div>

                        <span class="text-success fs-5">
                            <i class="bi bi-arrow-up-right"></i>
                        </span>
                    </div>

                    <h1 class="fw-bold mt-4">{{ $layananAktif }}</h1>

                    <p class="text-muted mb-1">
                        Kategori
                    </p>

                    <small class="text-success fw-semibold">
                        {{ $layananAktif }} aktif
                    </small>
                </div>
            </div>
        </div>

        <!-- Total User -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div class="text-white rounded-4 p-3"
                            style="background:#9333ea;">
                            <i class="bi bi-people fs-4"></i>
                        </div>

                        <span class="text-success fs-5">
                            <i class="bi bi-arrow-up-right"></i>
                        </span>
                    </div>

                    <h1 class="fw-bold mt-4">{{ $totalUser }}</h1>

                    <p class="text-muted mb-1">
                        Total Pengguna
                    </p>

                    <small class="text-success fw-semibold">
                        +{{ $userMingguIni }} minggu ini
                    </small>
                </div>
            </div>
        </div>

        <!-- User Aktif -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div class="text-white rounded-4 p-3"
                            style="background:#f97316;">
                            <i class="bi bi-person-check fs-4"></i>
                        </div>

                        <span class="text-success fs-5">
                            <i class="bi bi-arrow-up-right"></i>
                        </span>
                    </div>

                    <h1 class="fw-bold mt-4">{{ $userAktif }}</h1>

                    <p class="text-muted mb-1">
                        Pengguna Aktif
                    </p>

                    <small class="text-success fw-semibold">
                        {{ $persentaseUser }}% online
                    </small>
                </div>
            </div>
        </div>

    </div>

    <!-- Chart -->
    <div class="row mt-4 g-4">

        <!-- Pertumbuhan Pengguna -->
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">
                        Pertumbuhan Pengguna
                    </h4>

                    <div style="height:320px;">
                        <canvas id="userChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Penggunaan Layanan
                    </h4>

                    <canvas id="layananChart"
                        style="height:300px;">
                    </canvas>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Grafik Pertumbuhan Pengguna
    const userChart = new Chart(
        document.getElementById('userChart'), {
            type: 'line',
            data: {
                labels: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun'
                ],
                datasets: [{
                    label: 'Jumlah Pengguna',
                    data: @json($pertumbuhanUser),
                    borderColor: '#3b82f6',
                    backgroundColor: '#3b82f6',
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 5,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        }
    );


    // Pie Chart Layanan
    const layananChart = new Chart(
        document.getElementById('layananChart'), {
            type: 'pie',
            data: {
                labels: @json($layananChart->pluck('nama')),
                datasets: [{
                    data: @json($layananChart->pluck('total')),
                    backgroundColor: [
                        '#3B82F6',
                        '#F59E0B',
                        '#10B981',
                        '#EC4899',
                        '#8B5CF6',
                        '#EF4444'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        }
    );
</script>

@endpush