@extends('layouts.admin.app')

@section('content')

<style>
    .card-custom {
        border-radius: 15px;
        padding: 20px;
        background: #f9fafc;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .05);
    }

    .search-input {
        border-radius: 25px;
        padding-left: 40px;
    }

    .btn-gradient {
        background: linear-gradient(to right, #4f46e5, #6366f1);
        color: white;
        border: none;
        border-radius: 25px;
        padding: 8px 20px;
    }

    .btn-gradient:hover {
        color: white;
    }

    .modal-header {
        background: #f8fafc;
    }
</style>

<div class="container mt-4">

    <h2 class="mb-1">
        <strong>Kelola Kategori</strong>
    </h2>

    <p class="text-muted">
        Tambah, edit, atau hapus Kategori yang tersedia
    </p>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card-custom mt-4">

        <div class="d-flex justify-content-between mb-3">

            <div class="position-relative w-75">
                <i class="fa fa-search position-absolute"
                    style="top:10px; left:15px; color:#aaa;">
                </i>

                <input type="text"
                    id="search"
                    class="form-control search-input"
                    placeholder="Cari Kategori...">
            </div>

            <button class="btn btn-gradient"
                data-bs-toggle="modal"
                data-bs-target="#tambahModal">
                + Tambah Kategori
            </button>

        </div>

        <table class="table align-middle">

            <thead>
                <tr>
                    {{-- Kolom No sudah dihapus --}}
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th class="text-center" style="width: 15%">Aksi</th>
                </tr>
            </thead>

            <tbody id="tableBody">

                @forelse($data as $item) {{-- $index sudah tidak diperlukan --}}

                <tr>
                    {{-- Kolom angka nomor sudah dihapus --}}

                    <td>
                        <strong>{{ $item->nama }}</strong>
                    </td>

                    <td>
                        <span class="text-muted">
                            {{ $item->deskripsi ?? '-' }}
                        </span>
                    </td>

                    <td class="text-center">

                        <button class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $item->id }}">
                            <i class="fas fa-pen"></i>
                        </button>

                        <form method="POST"
                            action="{{ route('admin.kategori.delete', $item->id) }}"
                            class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>

                        </form>

                    </td>

                </tr>

                <div class="modal fade"
                    id="editModal{{ $item->id }}"
                    tabindex="-1">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <form action="{{ route('admin.kategori.update', $item->id) }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <div class="modal-header">

                                    <h5 class="modal-title">
                                        Edit Kategori
                                    </h5>

                                    <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label class="form-label">Nama Kategori</label>
                                        <input type="text"
                                            name="nama"
                                            class="form-control"
                                            value="{{ $item->nama }}"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi"
                                            class="form-control"
                                            rows="3">{{ $item->deskripsi }}</textarea>
                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">
                                        Batal
                                    </button>

                                    <button type="submit"
                                        class="btn btn-primary">
                                        Update
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

                @empty

                <tr>
                    {{-- Colspan diubah menjadi 3 karena jumlah kolom sekarang hanya ada 3 --}}
                    <td colspan="3" class="text-center text-muted">
                        Belum ada data kategori
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="modal fade"
    id="tambahModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="{{ route('admin.kategori.store') }}"
                method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Kategori
                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Masukkan nama kategori..."
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi"
                            class="form-control"
                            placeholder="Masukkan deskripsi singkat (opsional)..."
                            rows="3"></textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                        class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    document.getElementById('search').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            // Abaikan baris "Belum ada data" agar pencarian tidak merusak struktur tabel kosong
            if (row.querySelector('td').getAttribute('colspan')) return;

            row.style.display =
                row.innerText.toLowerCase().includes(value) ?
                '' :
                'none';
        });
    });
</script>

@endsection