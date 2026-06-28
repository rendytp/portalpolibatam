@extends('layouts.user.app')

@section('content')
<div x-data="{ showAddModal: false, showEditModal: null }">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold">Custom Links</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Simpan link kustom Anda sendiri untuk akses cepat</p>
            </div>
        </div>
        <button @click="showAddModal = true" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium smooth-transition flex items-center gap-2 shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Link
        </button>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 p-4 rounded-xl flex items-center gap-3 mb-6">
        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->has('msg'))
    <div class="bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800 p-4 rounded-xl flex items-center gap-3 mb-6">
        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span class="font-medium">{{ $errors->first('msg') }}</span>
    </div>
@endif  

    @if($links->isEmpty())
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-12 text-center shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col items-center justify-center min-h-[400px]">
            <div class="w-20 h-20 bg-blue-50 dark:bg-blue-900/30 text-blue-500 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            </div>
            <p class="text-slate-500 dark:text-slate-400 mb-6 text-lg">Belum ada custom link</p>
            <button @click="showAddModal = true" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium smooth-transition shadow-md">
                Tambah Link Pertama
            </button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($links as $link)
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col hover:shadow-lg transition">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    </div>
                    <h4 class="font-bold text-lg text-slate-800 dark:text-white truncate">{{ $link->judul_link }}</h4>
                </div>
                
                <p class="text-sm text-slate-500 dark:text-slate-400 mb-2 flex-1">{{ $link->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                <a href="{{ $link->url_link }}" target="_blank" class="text-blue-500 text-sm hover:underline block mb-6 truncate">{{ $link->url_link }}</a>
                
                <div class="flex items-center gap-2 mt-auto">
                    <a href="{{ $link->url_link }}" target="_blank" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-xl text-center text-sm font-semibold flex items-center justify-center gap-2 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        Buka
                    </a>
                    
                    <button @click="showEditModal = {{ $link->id }}" class="p-2.5 text-blue-600 bg-blue-50 hover:bg-blue-100 dark:bg-slate-700 dark:hover:bg-slate-600 dark:text-blue-400 rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    
                    <form action="{{ route('custom.links.delete', $link->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus link ini?')" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2.5 text-red-600 bg-red-50 hover:bg-red-100 dark:bg-slate-700 dark:hover:bg-slate-600 dark:text-red-400 rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            <div x-show="showEditModal === {{ $link->id }}" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm px-4">
                <div @click.away="showEditModal = null" class="bg-white dark:bg-slate-800 rounded-3xl w-full max-w-md shadow-2xl overflow-hidden"
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    
                    <div class="flex justify-between items-center p-6 border-b border-slate-100 dark:border-slate-700">
                        <h3 class="text-xl font-bold text-slate-800 dark:text-white">Edit Link</h3>
                        <button @click="showEditModal = null" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <form action="{{ route('custom.links.update', $link->id) }}" method="POST" class="p-6">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Link <span class="text-red-500">*</span></label>
                            <input type="text" name="judul_link" value="{{ $link->judul_link }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">URL <span class="text-red-500">*</span></label>
                            <input type="url" name="url_link" value="{{ $link->url_link }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $link->deskripsi }}</textarea>
                        </div>
                        
                        <div class="flex gap-4">
                            <button type="button" @click="showEditModal = null" class="flex-1 py-3 rounded-xl border border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-300 font-semibold hover:bg-slate-50 dark:hover:bg-slate-700 transition">Batal</button>
                            <button type="submit" class="flex-1 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Update Link</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <div x-show="showAddModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm px-4">
        <div @click.away="showAddModal = false" class="bg-white dark:bg-slate-800 rounded-3xl w-full max-w-md shadow-2xl overflow-hidden"
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
             
            <div class="flex justify-between items-center p-6 border-b border-slate-100 dark:border-slate-700">
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">Tambah Link Baru</h3>
                <button @click="showAddModal = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('custom.links.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Link <span class="text-red-500">*</span></label>
                    <input type="text" name="judul_link" placeholder="e.g., Google Drive" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">URL <span class="text-red-500">*</span></label>
                    <input type="url" name="url_link" placeholder="https://..." class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" placeholder="Deskripsi singkat (opsional)" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                
                <div class="flex gap-4">
                    <button type="button" @click="showAddModal = false" class="flex-1 py-3 rounded-xl border border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-300 font-semibold hover:bg-slate-50 dark:hover:bg-slate-700 transition">Batal</button>
                    <button type="submit" class="flex-1 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection