@extends('layouts.user.app')

@section('content')
    <div class="mb-8 flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
        </div>
        <div>
            <h1 class="text-3xl font-bold">Selamat Datang, {{ $user->username }}!</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Akses semua layanan Polibatam dengan mudah dan cepat</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-3xl p-6 text-white shadow-xl shadow-blue-500/20 relative overflow-hidden transform hover:-translate-y-1 smooth-transition">
            <p class="font-medium text-blue-100 mb-1 relative z-10">Total Layanan</p>
            <h2 class="text-5xl font-bold relative z-10">{{ $totalLayanan }}</h2>
        </div>
        <div class="bg-gradient-to-br from-orange-400 to-orange-500 rounded-3xl p-6 text-white shadow-xl shadow-orange-500/20 relative overflow-hidden transform hover:-translate-y-1 smooth-transition">
            <p class="font-medium text-orange-100 mb-1 relative z-10">Favorit Saya</p>
            <h2 class="text-5xl font-bold relative z-10">{{ $favoritCount }}</h2>
        </div>
        <div class="bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-3xl p-6 text-white shadow-xl shadow-emerald-500/20 relative overflow-hidden transform hover:-translate-y-1 smooth-transition">
            <p class="font-medium text-emerald-100 mb-1 relative z-10">Layanan Aktif</p>
            <h2 class="text-5xl font-bold relative z-10">{{ $totalLayanan }}</h2>
        </div>
    </div>

    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold">Semua Layanan <span class="ml-2 px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-400 text-xs font-bold rounded-full">{{ $totalLayanan }} layanan</span></h3>
    </div>
    
    <form action="{{ route('cari') }}" method="GET" class="flex gap-4 mb-8">
        <input type="text" name="q" placeholder="Cari layanan..." class="flex-1 px-6 py-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="px-8 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition">Cari</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($layanans as $layanan)
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-blue-500/5 flex flex-col h-full smooth-transition">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg></div>
            </div>
            <h4 class="font-bold text-lg mb-1">{{ $layanan->nama }}</h4>
            <div class="flex items-center gap-2 mb-3"><span class="w-2 h-2 rounded-full bg-emerald-500"></span><span class="text-xs font-bold text-emerald-500">Aktif</span></div>
            <p class="text-sm text-slate-500 dark:text-slate-400 flex-1 mb-6">{{ $layanan->deskripsi }}</p>
            <a href="{{ $layanan->url }}" target="_blank" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm text-center rounded-xl shadow-md smooth-transition">Akses Layanan</a>
        </div>
        @endforeach
    </div>
@endsection