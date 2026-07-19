@extends('layouts.admin.app')

@section('content')

<style>
    .card-custom {
        border-radius: 16px;
        padding: 20px;
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
        border: 1px solid #e5e7eb;
    }

    .search-input {
        border-radius: 25px;
        padding-left: 40px;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        border: none;
        border-radius: 25px;
        padding: 8px 20px;
        font-weight: 500;
    }

    .btn-gradient:hover {
        color: white;
        opacity: .95;
    }

    .btn-excel {
        background: linear-gradient(135deg, #16a34a, #22c55e);
        color: white;
        border: none;
        border-radius: 25px;
        padding: 8px 20px;
        font-weight: 500;
    }

    .btn-excel:hover {
        color: white;
        opacity: .95;
    }

    .modal-header {
        background: #f8fafc;
    }

    /* KATEGORI */
    .badge-kategori {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        background: #dbeafe;
        color: #2563eb;
        border: 1px solid #93c5fd;
    }

    /* STATUS BASE */
    .badge-status {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        min-width: 140px !important;
        height: 30px !important;
        padding: 0 14px !important;
        border-radius: 999px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        transition: all .3s ease;
    }

    .badge-status::before {
        content: "" !important;
        width: 8px !important;
        height: 8px !important;
        border-radius: 50% !important;
        flex-shrink: 0 !important;
        display: inline-block !important;
    }

    span.badge-status.badge-aktif {
        color: #16a34a !important;
        background: rgba(34, 197, 94, 0.12) !important;
        border: 1px solid rgba(34, 197, 94, 0.30) !important;
    }

    span.badge-status.badge-aktif::before {
        background: #22c55e !important;
    }

    span.badge-status.badge-gangguan {
        color: #d97706 !important;
        background: rgba(245, 158, 11, 0.12) !important;
        border: 1px solid rgba(245, 158, 11, 0.35) !important;
    }

    span.badge-status.badge-gangguan::before {
        background: #f59e0b !important;
    }

    span.badge-status.badge-nonaktif {
        color: #dc2626 !important;
        background: rgba(239, 68, 68, 0.12) !important;
        border: 1px solid rgba(239, 68, 68, 0.35) !important;
    }

    span.badge-status.badge-nonaktif::before {
        background: #ef4444 !important;
    }

    /* DARK MODE */
    [data-bs-theme="dark"] .card-custom {
        background: #232336;
        border-color: #34344e;
    }

    [data-bs-theme="dark"] .badge-kategori {
        background: rgba(59, 130, 246, .15);
        color: #60a5fa;
        border-color: rgba(59, 130, 246, .35);
    }

    [data-bs-theme="dark"] span.badge-status.badge-aktif {
        color: #4ade80 !important;
        background: rgba(34, 197, 94, 0.15) !important;
        border: 1px solid rgba(34, 197, 94, 0.35) !important;
    }

    [data-bs-theme="dark"] span.badge-status.badge-aktif::before {
        background: #4ade80 !important;
    }

    [data-bs-theme="dark"] span.badge-status.badge-gangguan {
        color: #fbbf24 !important;
        background: rgba(245, 158, 11, 0.15) !important;
        border: 1px solid rgba(245, 158, 11, 0.40) !important;
    }

    [data-bs-theme="dark"] span.badge-status.badge-gangguan::before {
        background: #fbbf24 !important;
    }

    [data-bs-theme="dark"] span.badge-status.badge-nonaktif {
        color: #f87171 !important;
        background: rgba(239, 68, 68, 0.15) !important;
        border: 1px solid rgba(239, 68, 68, 0.40) !important;
    }

    [data-bs-theme="dark"] span.badge-status.badge-nonaktif::before {
        background: #f87171 !important;
    }

    table tbody tr {
        transition: .2s;
    }

    table tbody tr:hover {
        background: rgba(99, 102, 241, 0.04);
    }

    [data-bs-theme="dark"] table tbody tr:hover {
        background: rgba(255, 255, 255, .03);
    }

    /* EXCEL MODAL */
    .filter-kategori-btn {
        border-radius: 999px;
        font-size: 12px;
        padding: 4px 14px;
        border: 1px solid #d1d5db;
        background: white;
        cursor: pointer;
        transition: all .15s;
        color: #374151;
    }

    .filter-kategori-btn.active {
        background: #6366f1;
        border-color: #6366f1;
        color: white;
    }

    [data-bs-theme="dark"] .filter-kategori-btn {
        background: #2d2d44;
        border-color: #3f3f5e;
        color: #d1d5db;
    }

    [data-bs-theme="dark"] .filter-kategori-btn.active {
        background: #6366f1;
        border-color: #6366f1;
        color: white;
    }

    .excel-list-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        border-radius: 8px;
        transition: background .15s;
        cursor: pointer;
    }

    .excel-list-item:hover {
        background: rgba(99, 102, 241, 0.06);
    }

    [data-bs-theme="dark"] .excel-list-item:hover {
        background: rgba(255, 255, 255, .04);
    }

    .excel-list-item label {
        cursor: pointer;
        flex: 1;
        margin: 0;
        font-size: 14px;
    }

    .badge-kat-small {
        font-size: 10px;
        padding: 2px 8px;
        border-radius: 999px;
        background: #dbeafe;
        color: #2563eb;
        white-space: nowrap;
    }

    [data-bs-theme="dark"] .badge-kat-small {
        background: rgba(59, 130, 246, .15);
        color: #60a5fa;
    }

    #excelList {
        max-height: 320px;
        overflow-y: auto;
    }

    .counter-badge {
        display: inline-block;
        background: #6366f1;
        color: white;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 999px;
        min-width: 20px;
        text-align: center;
    }
</style>

<div class="container mt-4">

    <h2 class="mb-1"><strong>Kelola Layanan</strong></h2>
    <p class="text-muted">Tambah, edit, atau hapus layanan yang tersedia</p>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        Pastikan URL diisi dengan format yang benar (contoh: https://google.com)
    </div>
    @endif

    <div class="card-custom mt-4">
        <div class="d-flex justify-content-between mb-3 gap-2 flex-wrap">
            <div class="position-relative" style="flex:1; min-width:200px;">
                <i class="fa fa-search position-absolute" style="top:10px; left:15px; color:#aaa;"></i>
                <input type="text" id="search" class="form-control search-input" placeholder="Cari layanan...">
            </div>
            <div class="d-flex gap-2">
                <!-- Tombol Ekspor Excel -->
                <button class="btn btn-excel" data-bs-toggle="modal" data-bs-target="#excelModal">
                    <i class="fas fa-file-excel me-1"></i> Ekspor Excel
                </button>
                <!-- Tombol Tambah -->
                <button class="btn btn-gradient" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    + Tambah Layanan
                </button>
            </div>
        </div>

        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Nama Layanan</th>
                    <th>Kategori</th>
                    <th>URL</th>
                    <th>Status Otomatis</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($data as $item)
                <tr>
                    <td>
                        <strong>{{ $item->nama }}</strong>
                        @if($item->deskripsi)
                        <br><small class="text-muted">{{ $item->deskripsi }}</small>
                        @endif
                    </td>
                    <td>
                        <span class="badge-kategori">{{ $item->kategori ?? 'Tanpa Kategori' }}</span>
                    </td>
                    <td>
                        <a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a>
                    </td>
                    <td>
                        @if($item->is_active == 1)
                        <span class="badge-status badge-aktif">Aktif</span>
                        @elseif($item->is_active == 2)
                        <span class="badge-status badge-gangguan">Sedang Gangguan</span>
                        @else
                        <span class="badge-status badge-nonaktif">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                            <i class="fas fa-pen"></i>
                        </button>
                        <form method="POST" action="{{ route('admin.layanan.delete', $item->id) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.layanan.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Layanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Kategori</label>
                                        <select name="id_kategori" class="form-control" required>
                                            @foreach($kategori as $k)
                                            <option value="{{ $k->id }}" {{ $item->id_kategori == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Layanan</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>URL</label>
                                        <input type="text" name="url" class="form-control" value="{{ $item->url }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="3">{{ $item->deskripsi }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Update & Cek Link Otomatis</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data layanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ===================== MODAL TAMBAH ===================== -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.layanan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Nama Layanan</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>URL</label>
                        <input type="url" name="url" class="form-control" placeholder="https://..." required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan & Cek Link Otomatis</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===================== MODAL EKSPOR EXCEL ===================== -->
<div class="modal fade" id="excelModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.layanan.export') }}" method="POST" id="excelForm">
                @csrf
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title mb-0">
                            <i class="fas fa-file-excel text-success me-2"></i>
                            Ekspor Layanan ke Excel
                        </h5>
                        <small class="text-muted">Pilih layanan yang ingin diekspor</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- Filter Kategori --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="text-muted" style="font-size:13px;">Filter:</span>
                            <button type="button" class="filter-kategori-btn active" data-kat="semua" onclick="filterKategori(this, 'semua')">
                                Semua
                            </button>
                            @foreach($kategori as $k)
                            <button type="button" class="filter-kategori-btn" data-kat="{{ $k->id }}" onclick="filterKategori(this, '{{ $k->id }}')">
                                {{ $k->nama }}
                            </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Aksi Cepat --}}
                    <div class="d-flex align-items-center justify-content-between mb-2 px-1">
                        <div class="d-flex align-items-center gap-2">
                            <input type="checkbox" id="pilihSemua" onchange="togglePilihSemua(this)" style="width:16px;height:16px;cursor:pointer;">
                            <label for="pilihSemua" style="cursor:pointer;font-size:13px;margin:0;">Pilih semua yang tampil</label>
                        </div>
                        <span>
                            <span class="counter-badge" id="counterBadge">0</span>
                            <span class="text-muted" style="font-size:12px;"> dipilih</span>
                        </span>
                    </div>

                    {{-- Daftar Layanan --}}
                    <div id="excelList" class="border rounded-3 p-2">
                        @foreach($data as $item)
                        <div class="excel-list-item" data-kat="{{ $item->id_kategori }}">
                            <input
                                type="checkbox"
                                name="ids[]"
                                value="{{ $item->id }}"
                                id="chk_{{ $item->id }}"
                                class="layanan-chk"
                                style="width:16px;height:16px;cursor:pointer;"
                                onchange="updateCounter()">
                            <label for="chk_{{ $item->id }}" class="d-flex align-items-center justify-content-between gap-2">
                                <div>
                                    <div style="font-weight:500;">{{ $item->nama }}</div>
                                    @if($item->deskripsi)
                                    <div style="font-size:12px;color:#6b7280;">{{ $item->deskripsi }}</div>
                                    @endif
                                </div>
                                <span class="badge-kat-small">{{ $item->kategori ?? 'Tanpa Kategori' }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-excel" id="btnEkspor" disabled>
                        <i class="fas fa-download me-1"></i>
                        Ekspor Excel (<span id="counterBtn">0</span> layanan)
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // ── SEARCH ──
    document.getElementById('search').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
        });
    });

    // ── FILTER KATEGORI ──
    function filterKategori(btn, kat) {
        // Update tombol aktif
        document.querySelectorAll('.filter-kategori-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Tampilkan/sembunyikan item
        document.querySelectorAll('.excel-list-item').forEach(item => {
            if (kat === 'semua' || item.dataset.kat === kat) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });

        // Reset pilih semua
        document.getElementById('pilihSemua').checked = false;
        updateCounter();
    }

    // ── PILIH SEMUA (hanya yang tampil) ──
    function togglePilihSemua(master) {
        const visible = [...document.querySelectorAll('.excel-list-item')]
            .filter(el => el.style.display !== 'none');

        visible.forEach(el => {
            const chk = el.querySelector('.layanan-chk');
            if (chk) chk.checked = master.checked;
        });

        updateCounter();
    }

    // ── UPDATE COUNTER ──
    function updateCounter() {
        const total = document.querySelectorAll('.layanan-chk:checked').length;
        document.getElementById('counterBadge').textContent = total;
        document.getElementById('counterBtn').textContent = total;
        document.getElementById('btnEkspor').disabled = total === 0;

        // Sinkronisasi checkbox "pilih semua"
        const visible = [...document.querySelectorAll('.excel-list-item')]
            .filter(el => el.style.display !== 'none');
        const visibleChecked = visible.filter(el => el.querySelector('.layanan-chk:checked')).length;
        const master = document.getElementById('pilihSemua');
        master.indeterminate = visibleChecked > 0 && visibleChecked < visible.length;
        master.checked = visible.length > 0 && visibleChecked === visible.length;
    }

    // Reset modal saat ditutup
    document.getElementById('excelModal').addEventListener('hidden.bs.modal', function() {
        document.querySelectorAll('.layanan-chk').forEach(c => c.checked = false);
        document.getElementById('pilihSemua').checked = false;
        filterKategori(document.querySelector('.filter-kategori-btn[data-kat="semua"]'), 'semua');
        updateCounter();
    });
</script>
@endsection