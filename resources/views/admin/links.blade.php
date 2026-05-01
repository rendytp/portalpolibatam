@extends('layouts.admin.app')

@section('content')

<style>
    .card-link {
        border-radius: 15px;
        padding: 20px;
        background: #f9fafc;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: 0.2s;
    }

    .card-link:hover {
        transform: translateY(-5px);
    }

    .icon-link {
        width: 40px;
        height: 40px;
        background: #10b981;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 10px;
    }

    .btn-gradient {
        background: linear-gradient(to right, #4f46e5, #6366f1);
        color: white;
        border-radius: 20px;
        padding: 8px 15px;
        border: none;
    }

    .btn-gradient:hover {
        opacity: 0.9;
    }

    .action-icon i {
        cursor: pointer;
        margin-left: 10px;
    }
</style>

<div class="container mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3><strong>Custom Links</strong></h3>
            <p class="text-muted">Simpan link kustom Anda sendiri untuk akses cepat</p>
        </div>

        <button class="btn btn-gradient" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Link
        </button>
    </div>

    {{-- LIST CARD --}}
    <div class="row">

        @forelse($data as $item)
        <div class="col-md-4 mb-4">
            <div class="card-link">

                {{-- TITLE --}}
                <div class="d-flex align-items-center mb-2">
                    <div class="icon-link">
                        <i class="fa fa-link"></i>
                    </div>
                    <strong>{{ $item->judul_link }}</strong>
                </div>

                {{-- URL --}}
                <small class="text-muted">
                    {{ $item->url_link }}
                </small>

                {{-- ACTION --}}
                <div class="d-flex justify-content-between align-items-center mt-3">

                    {{-- BUTTON BUKA --}}
                    <a href="{{ $item->url_link }}" target="_blank" class="btn btn-gradient">
                        <i class="fa fa-external-link-alt"></i> Buka
                    </a>

                    {{-- ICON --}}
                    <div class="action-icon">

                        {{-- EDIT --}}
                        <i class="fa fa-pen text-primary"></i>

                        {{-- DELETE --}}
                        <form method="POST" action="{{ route('admin.links.delete', $item->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button style="border:none; background:none;">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </form>

                    </div>

                </div>

            </div>
        </div>
        @empty

        {{-- EMPTY STATE --}}
        <div class="col-12 text-center">
            <p class="text-muted">Belum ada custom link</p>
        </div>

        @endforelse

    </div>

</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{ route('admin.links.store') }}">
                @csrf

                <div class="modal-header">
                    <h5>Tambah Link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="text" name="judul_link" class="form-control mb-3" placeholder="Judul Link" required>

                    <input type="text" name="url_link" class="form-control" placeholder="URL Link" required>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-gradient">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection