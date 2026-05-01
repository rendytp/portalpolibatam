@extends('layouts.admin.app')

@section('content')

<style>
    .card-custom {
        border-radius: 15px;
        padding: 20px;
        background: #f9fafc;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .search-input {
        border-radius: 25px;
        padding-left: 40px;
    }

    .badge-kategori {
        background: #e0edff;
        color: #2b6cb0;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
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
        border-radius: 25px;
        padding: 8px 20px;
    }

    .action-btn i {
        font-size: 18px;
        margin: 0 5px;
        cursor: pointer;
    }
</style>

<div class="container mt-4">

    <h2 class="mb-1"><strong>Kelola Layanan</strong></h2>
    <p class="text-muted">Tambah, edit, atau hapus layanan yang tersedia</p>

    <div class="card-custom mt-4">

        {{-- SEARCH + BUTTON --}}
        <div class="d-flex justify-content-between mb-3">
            <div class="position-relative w-75">
                <i class="fa fa-search position-absolute" style="top:10px; left:15px; color:#aaa;"></i>
                <input type="text" id="search" class="form-control search-input" placeholder="Cari layanan...">
            </div>

            <button class="btn btn-gradient">
                + Tambah Layanan
            </button>
        </div>

        {{-- TABLE --}}
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
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->nama }}</td>

                    <td>
                        <span class="badge-kategori">
                            {{ $item->kategori ?? 'Umum' }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ $item->url ?? '#' }}" target="_blank">
                            {{ $item->url ?? '-' }}
                        </a>
                    </td>

                    <td>
                        <span class="badge-status">
                            {{ $item->status ?? 'Aktif' }}
                        </span>
                    </td>

                    <td class="text-center">

                        {{-- EDIT --}}
                        <a href="#" class="text-primary me-2">
                            <i class="fas fa-pen"></i>
                        </a>

                        {{-- DELETE --}}
                        <form method="POST" action="{{ route('admin.layanan.delete', $item->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button style="border:none; background:none;">
                                <i class="fas fa-trash text-danger"></i>
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

{{-- SEARCH REALTIME --}}
<script>
    document.getElementById('search').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll("#tableBody tr");

        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>

@endsection