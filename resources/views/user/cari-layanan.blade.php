@extends('layouts.user.app')

@section('content')
    <div class="mb-8 flex items-center gap-4">
        <div class="w-12 h-12 bg-gradient-to-r from-fuchsia-500 to-pink-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-pink-500/30">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <div>
            <h1 class="text-3xl font-bold">Cari Layanan</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Temukan layanan yang Anda butuhkan dengan cepat</p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto mb-10 text-center">
        <form action="{{ route('cari') }}" method="GET">
            <input type="text" name="q" value="{{ $keyword }}" placeholder="Ketik nama layanan..." class="w-full px-8 py-5 rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-pink-500 text-lg transition text-center outline-none">
        </form>
        <p class="text-sm text-slate-500 mt-6">Ditemukan <span class="font-bold text-pink-600">{{ count($layanans) }}</span> layanan</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($layanans as $layanan)
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-pink-500/5 flex flex-col h-full smooth-transition">
            <h4 class="font-bold text-lg mb-1 mt-4">{{ $layanan->nama }}</h4>
            <div class="flex items-center gap-2 mb-3"><span class="w-2 h-2 rounded-full bg-emerald-500"></span><span class="text-xs font-bold text-emerald-500">Aktif</span></div>
            <p class="text-sm text-slate-500 dark:text-slate-400 flex-1 mb-6">{{ $layanan->deskripsi }}</p>
            <a href="{{ $layanan->url }}" target="_blank" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm text-center rounded-xl shadow-md smooth-transition">Akses Layanan</a>
        </div>
        @empty
        <div class="col-span-full text-center py-10 text-slate-500">Layanan tidak ditemukan.</div>
        @endforelse
    </div>
@endsection