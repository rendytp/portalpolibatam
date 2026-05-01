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

    .badge-role {
        background: #f3e8ff;
        color: #9333ea;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .user-icon {
        color: #2563eb;
        margin-right: 8px;
    }

    .text-muted-small {
        color: #888;
        font-size: 13px;
    }
</style>

<div class="container mt-4">

    <h3><strong>Kelola Pengguna</strong></h3>
    <p class="text-muted">Lihat dan kelola data pengguna yang terdaftar</p>

    <div class="card-custom mt-4">

        {{-- SEARCH --}}
        <div class="position-relative mb-4">
            <i class="fa fa-search position-absolute" style="top:10px; left:15px; color:#aaa;"></i>
            <input type="text" id="searchUser" class="form-control search-input" placeholder="Cari pengguna...">
        </div>

        {{-- TABLE --}}
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Jumlah Bookmark</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>

            <tbody id="userTable">
                @forelse($data as $user)
                <tr>
                    <td>
                        <i class="fa fa-user user-icon"></i>
                        {{ $user->username }}
                        @if(auth()->id() == $user->id)
                        <span class="text-muted-small">(Anda)</span>
                        @endif
                    </td>

                    <td>
                        <span class="badge-role">
                            {{ $user->role ?? 'User' }}
                        </span>
                    </td>

                    <td>
                        {{ $user->bookmarks_count ?? 0 }}
                    </td>

                    <td class="text-end">

                        @if(auth()->id() == $user->id)
                        <span class="text-muted-small">Admin aktif</span>
                        @else
                        <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button style="border:none; background:none;">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </form>
                        @endif

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Tidak ada pengguna yang ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- FOOTER --}}
        <hr>
        <p class="text-muted-small">
            Total Pengguna: <strong>{{ count($data) }}</strong> (termasuk Anda)
        </p>

    </div>

</div>

{{-- SEARCH REALTIME --}}
<script>
    document.getElementById('searchUser').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll("#userTable tr");

        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>

@endsection