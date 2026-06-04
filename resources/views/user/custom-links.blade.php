@extends('layouts.user.app')

@section('content')
    <div x-data="{ showModal: false }">
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Custom Links</h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-1">Simpan link kustom Anda sendiri untuk akses cepat</p>
                </div>
            </div>
            <button @click="showModal = true" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg smooth-transition">
                + Tambah Link
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($links as $link)
            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col h-full">
                <h4 class="font-bold text-lg mb-2">{{ $link->judul_link }}</h4>
                <a href="{{ $link->url_link }}" class="text-blue-500 text-sm hover:underline mb-6 truncate block">{{ $link->url_link }}</a>
                <a href="{{ $link->url_link }}" target="_blank" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm text-center rounded-xl smooth-transition mt-auto">Buka Link</a>
            </div>
            @empty
            <div class="col-span-full text-center py-8 text-slate-500">Belum ada link yang ditambahkan.</div>
            @endforelse
        </div>

        <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="showModal = false"></div>
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 w-full max-w-md relative z-10 shadow-2xl border border-slate-200 dark:border-slate-700">
                <h3 class="text-xl font-bold mb-6">Tambah Link Baru</h3>
                <form action="{{ route('custom.links.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Nama Link *</label>
                        <input type="text" name="judul_link" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 outline-none" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-2">URL *</label>
                        <input type="url" name="url_link" placeholder="https://" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 outline-none" required>
                    </div>
                    <div class="flex gap-4">
                        <button type="button" @click="showModal = false" class="flex-1 py-3 px-4 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold rounded-xl transition">Batal</button>
                        <button type="submit" class="flex-1 py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transition">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection