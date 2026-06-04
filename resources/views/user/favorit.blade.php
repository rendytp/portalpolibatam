@extends('layouts.user.app')

@section('content')
    <div class="mb-10 flex items-center gap-4">
        <div class="w-12 h-12 bg-gradient-to-r from-orange-400 to-orange-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-500/30">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
        </div>
        <div>
            <h1 class="text-3xl font-bold">Layanan Favorit</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1"><span class="font-bold text-orange-500">{{ count($layanans) }}</span> layanan yang Anda tandai sebagai favorit</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($layanans as $layanan)
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-orange-500/5 flex flex-col h-full smooth-transition border-t-4 border-t-orange-400">
            <h4 class="font-bold text-lg mb-1 mt-2">{{ $layanan->nama }}</h4>
            <div class="flex items-center gap-2 mb-3"><span class="w-2 h-2 rounded-full bg-emerald-500"></span><span class="text-xs font-bold text-emerald-500">Aktif</span></div>
            <p class="text-sm text-slate-500 dark:text-slate-400 flex-1 mb-6">{{ $layanan->deskripsi }}</p>
            <a href="{{ $layanan->url }}" target="_blank" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm text-center rounded-xl shadow-md smooth-transition">Akses Layanan</a>
        </div>
        @empty
        <div class="col-span-full p-10 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-dashed border-slate-300 dark:border-slate-700 text-center">
            <p class="text-slate-500">Anda belum menambahkan layanan favorit.</p>
        </div>
        @endforelse
    </div>
@endsection