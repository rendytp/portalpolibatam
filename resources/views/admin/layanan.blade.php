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

    .badge-kategori {
        background: #e0edff;
        color: #2563eb;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .badge-status {
        background: #c6f6d5;
        color: #2f855a;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
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
        <strong>Kelola Layanan</strong>
    </h2>

    <p class="text-muted">
        Tambah, edit, atau hapus layanan yang tersedia
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
                    placeholder="Cari layanan...">
            </div>

            <button class="btn btn-gradient"
                data-bs-toggle="modal"
                data-bs-target="#tambahModal">
                + Tambah Layanan
            </button>

        </div>

        <table class="table align-middle">

            <thead>
                <tr>
                    <th>Nama Layanan</th>
                    <th>Kategori</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody id="tableBody">

                @forelse($data as $item)

                <tr>

                    <td>
                        <strong>{{ $item->nama }}</strong>

                        @if($item->deskripsi)
                        <br>
                        <small class="text-muted">
                            {{ $item->deskripsi }}
                        </small>
                        @endif
                    </td>

                    <td>
                        <span class="badge-kategori">
                            {{ $item->kategori ?? 'Tanpa Kategori' }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ $item->url }}"
                            target="_blank">
                            {{ $item->url }}
                        </a>
                    </td>

                    <td>

                        @if($item->is_active)

                        <span class="badge-status">
                            Aktif
                        </span>

                        @else

                        <span class="badge bg-danger">
                            Nonaktif
                        </span>

                        @endif

                    </td>

                    <td class="text-center">

                        <button class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $item->id }}">
                            <i class="fas fa-pen"></i>
                        </button>

                        <form method="POST"
                            action="{{ route('admin.layanan.delete', $item->id) }}"
                            class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>

                        </form>

                    </td>

                </tr>

                <!-- MODAL EDIT -->
                <div class="modal fade"
                    id="editModal{{ $item->id }}"
                    tabindex="-1">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <form action="{{ route('admin.layanan.update', $item->id) }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <div class="modal-header">

                                    <h5 class="modal-title">
                                        Edit Layanan
                                    </h5>

                                    <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label>Kategori</label>

                                        <select name="id_kategori"
                                            class="form-control"
                                            required>

                                            @foreach($kategori as $k)

                                            <option value="{{ $k->id }}"
                                                {{ $item->id_kategori == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama }}
                                            </option>

                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Nama Layanan</label>

                                        <input type="text"
                                            name="nama"
                                            class="form-control"
                                            value="{{ $item->nama }}"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label>URL</label>

                                        <input type="text"
                                            name="url"
                                            class="form-control"
                                            value="{{ $item->url }}"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Deskripsi</label>

                                        <textarea name="deskripsi"
                                            class="form-control"
                                            rows="3">{{ $item->deskripsi }}</textarea>
                                    </div>

                                    <div class="form-check">

                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="is_active"
                                            value="1"
                                            {{ $item->is_active ? 'checked' : '' }}>

                                        <label class="form-check-label">
                                            Aktif
                                        </label>

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
                    <td colspan="5" class="text-center">
                        Belum ada data layanan
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- MODAL TAMBAH -->
<div class="modal fade"
    id="tambahModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="{{ route('admin.layanan.store') }}"
                method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Layanan
                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label>Kategori</label>

                        <select name="id_kategori"
                            class="form-control"
                            required>

                            <option value="">
                                Pilih Kategori
                            </option>

                            @foreach($kategori as $k)

                            <option value="{{ $k->id }}">
                                {{ $k->nama }}
                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Nama Layanan</label>

                        <input type="text"
                            name="nama"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>URL</label>

                        <input type="text"
                            name="url"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Deskripsi</label>

                        <textarea name="deskripsi"
                            class="form-control"
                            rows="3"></textarea>

                    </div>

                    <div class="form-check">

                        <input class="form-check-input"
                            type="checkbox"
                            name="is_active"
                            value="1"
                            checked>

                        <label class="form-check-label">
                            Aktif
                        </label>

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

            row.style.display =
                row.innerText.toLowerCase().includes(value) ?
                '' :
                'none';

        });

    });
</script>

@endsection