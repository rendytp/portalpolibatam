@extends('layouts.admin.app')

@section('content')

<style>
    .card-link {
        border-radius: 15px;
        padding: 20px;
        background: #fff;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: 0.2s;
        height: 100%;
    }

    .card-link:hover {
        transform: translateY(-3px);
    }

    .icon-link {
        width: 45px;
        height: 45px;
        background: #10b981;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
    }

    .link-title {
        font-size: 16px;
        font-weight: 600;
        color: #111827;
        word-break: break-word;
    }

    .link-desc {
        font-size: 13px;
        color: #6b7280;
        margin-top: 2px;
        word-break: break-word;
    }

    .link-url {
        display: block;
        color: #6b7280;
        font-size: 13px;
        line-height: 1.5;
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-all;
    }

    .btn-gradient {
        background: linear-gradient(to right, #4f46e5, #6366f1);
        color: white;
        border-radius: 20px;
        padding: 8px 15px;
        border: none;
    }

    .btn-gradient:hover {
        color: white;
        opacity: .9;
    }

    .action-icon {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .action-icon i {
        cursor: pointer;
        font-size: 15px;
    }

    .empty-state {
        padding: 50px 20px;
        text-align: center;
        color: #6b7280;
        background: #fff;
        border-radius: 15px;
        border: 1px solid #e5e7eb;
    }

    /* Dark mode */
    [data-bs-theme="dark"] .card-link {
        background: #232336;
        border-color: #34344e;
    }

    [data-bs-theme="dark"] .link-title {
        color: #f1f5f9;
    }

    [data-bs-theme="dark"] .empty-state {
        background: #232336;
        border-color: #34344e;
    }
</style>

<div class="container mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><strong>Custom Links</strong></h2>
            <p class="text-muted mb-0">Simpan link kustom Anda sendiri untuk akses cepat</p>
        </div>
        <button class="btn btn-gradient" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Link
        </button>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- CARD LIST --}}
    <div class="row">
        @forelse($data as $item)
        <div class="col-md-4 mb-4">
            <div class="card-link d-flex flex-column">

                {{-- HEADER --}}
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-link">
                        <i class="fa fa-link"></i>
                    </div>
                    <div class="ms-3">
                        <div class="link-title">{{ $item->judul_link }}</div>
                        @if($item->deskripsi)
                        <div class="link-desc">{{ $item->deskripsi }}</div>
                        @endif
                    </div>
                </div>

                {{-- URL --}}
                <div class="link-url mb-4">{{ $item->url_link }}</div>

                {{-- FOOTER --}}
                <div class="mt-auto d-flex justify-content-between align-items-center">
                    <a href="{{ $item->url_link }}" target="_blank" class="btn btn-gradient">
                        <i class="fa fa-external-link-alt"></i> Buka
                    </a>
                    <div class="action-icon">
                        <i class="fa fa-pen text-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $item->id }}">
                        </i>
                        <form method="POST"
                            action="{{ route('admin.links.delete', $item->id) }}"
                            onsubmit="return confirm('Yakin ingin menghapus link ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border:none;background:none;padding:0;">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        {{-- Modal Edit --}}
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.links.update', $item->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Link</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Judul Link</label>
                                <input type="text" name="judul_link" class="form-control"
                                    value="{{ $item->judul_link }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi <span class="text-muted">(opsional)</span></label>
                                <input type="text" name="deskripsi" class="form-control"
                                    value="{{ $item->deskripsi }}"
                                    placeholder="Contoh: Untuk login portal akademik">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">URL Link</label>
                                <input type="url" name="url_link" class="form-control"
                                    value="{{ $item->url_link }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fa fa-link fa-3x mb-3"></i>
                <h5>Belum Ada Custom Link</h5>
                <p class="mb-0">Tambahkan link pertama Anda untuk akses cepat.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.links.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Link</label>
                        <input type="text" name="judul_link" class="form-control"
                            placeholder="Contoh: Portal Akademik" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi <span class="text-muted">(opsional)</span></label>
                        <input type="text" name="deskripsi" class="form-control"
                            placeholder="Contoh: Untuk login portal akademik">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL Link</label>
                        <input type="url" name="url_link" class="form-control"
                            placeholder="https://example.com" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection