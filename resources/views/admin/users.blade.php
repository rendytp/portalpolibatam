@extends('layouts.admin.app')

@section('content')

<style>
    /* =========================
       CARD & FORM
    ========================= */

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

    /* =========================
       BADGE ROLE
    ========================= */

    .badge-role {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 4px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-role.badge-admin {
        color: #7c3aed;
        background: rgba(124, 58, 237, 0.12);
        border: 1px solid rgba(124, 58, 237, 0.30);
    }

    .badge-role.badge-staff {
        color: #0369a1;
        background: rgba(3, 105, 161, 0.12);
        border: 1px solid rgba(3, 105, 161, 0.30);
    }

    /* =========================
       BOOKMARK BADGE
    ========================= */

    .badge-bookmark {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        background: rgba(107, 114, 128, 0.10);
        border: 1px solid rgba(107, 114, 128, 0.25);
    }

    .badge-bookmark i {
        font-size: 11px;
    }

    /* =========================
       AVATAR
    ========================= */

    .user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 13px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* =========================
       DARK MODE
    ========================= */

    [data-bs-theme="dark"] .card-custom {
        background: #232336;
        border-color: #34344e;
    }

    [data-bs-theme="dark"] .badge-role.badge-admin {
        color: #a78bfa;
        background: rgba(124, 58, 237, 0.18);
        border-color: rgba(124, 58, 237, 0.35);
    }

    [data-bs-theme="dark"] .badge-role.badge-staff {
        color: #38bdf8;
        background: rgba(3, 105, 161, 0.18);
        border-color: rgba(3, 105, 161, 0.35);
    }

    [data-bs-theme="dark"] .badge-bookmark {
        color: #9ca3af;
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.12);
    }

    /* =========================
       TABLE
    ========================= */

    table tbody tr {
        transition: .2s;
    }

    table tbody tr:hover {
        background: rgba(99, 102, 241, 0.04);
    }

    [data-bs-theme="dark"] table tbody tr:hover {
        background: rgba(255, 255, 255, .03);
    }

    .text-you {
        font-size: 11px;
        color: #9ca3af;
        margin-left: 4px;
    }
</style>

<div class="container mt-4">

    <h2 class="mb-1"><strong>Kelola Pengguna</strong></h2>
    <p class="text-muted">Lihat dan kelola data pengguna yang terdaftar</p>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card-custom mt-4">
        <div class="position-relative mb-3">
            <i class="fa fa-search position-absolute" style="top:10px; left:15px; color:#aaa;"></i>
            <input type="text" id="search" class="form-control search-input" placeholder="Cari pengguna...">
        </div>

        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Jumlah Bookmark</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($data as $item)
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr($item->username, 0, 1)) }}
                            </div>
                            <div>
                                <strong>{{ $item->username }}</strong>
                                @if($item->id == auth()->id())
                                <span class="text-you">(Anda)</span>
                                @endif
                                @if($item->nama)
                                <br><small class="text-muted">{{ $item->nama }}</small>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        @if(strtolower($item->role) == 'admin')
                        <span class="badge-role badge-admin">Admin</span>
                        @else
                        <span class="badge-role badge-staff">Staff</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge-bookmark">
                            <i class="fas fa-bookmark"></i>
                            {{ $item->jumlah_bookmark }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if($item->id == auth()->id())
                        <span class="text-muted small">Admin aktif</span>
                        @else
                        <form method="POST" action="{{ route('admin.users.delete', $item->id) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data pengguna</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-2">
            <small class="text-muted">Total Pengguna: <strong>{{ $data->count() }}</strong> (termasuk Anda)</small>
        </div>
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>
@endsection