@extends('layouts.dashboard')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-500/30">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
        </div>
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white">Selamat Datang, rezaaja!</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">Akses semua layanan Polibatam dengan mudah dan cepat</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg shadow-blue-500/20 transform hover:-translate-y-1 smooth-transition">
            <div class="absolute top-0 right-0 p-4 opacity-50"><svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mb-4 backdrop-blur-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <p class="text-blue-100 text-sm font-medium mb-1">Total Layanan</p>
            <h2 class="text-4xl font-extrabold">{{ count($layanan) }}</h2>
        </div>
        <div class="relative overflow-hidden bg-gradient-to-br from-orange-400 to-orange-500 rounded-2xl p-6 text-white shadow-lg shadow-orange-500/20 transform hover:-translate-y-1 smooth-transition">
            <div class="absolute top-0 right-0 p-4 opacity-50"><svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg></div>
            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mb-4 backdrop-blur-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            </div>
            <p class="text-orange-100 text-sm font-medium mb-1">Favorit Saya</p>
            <h2 class="text-4xl font-extrabold">{{ collect($layanan)->where('is_fav', true)->count() }}</h2>
        </div>
        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-2xl p-6 text-white shadow-lg shadow-emerald-500/20 transform hover:-translate-y-1 smooth-transition">
            <div class="absolute top-4 right-6 w-3 h-3 bg-white rounded-full animate-pulse"></div>
            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mb-4 backdrop-blur-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
            <p class="text-emerald-100 text-sm font-medium mb-1">Layanan Aktif</p>
            <h2 class="text-4xl font-extrabold">{{ collect($layanan)->where('status', 'Aktif')->count() }}</h2>
        </div>
    </div>

    <div>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold flex items-center gap-2">
                <div class="p-1.5 bg-orange-100 dark:bg-orange-900/50 text-orange-500 rounded-lg"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg></div>
                Layanan Favorit
            </h2>
            <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 px-4 py-2 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 smooth-transition">Lihat Semua &rarr;</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($layanan as $item)
                @if($item['is_fav'])
                    @include('user.components.service-card', ['item' => $item])
                @endif
            @endforeach
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-4 bg-white dark:bg-slate-800 p-2 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
        <div class="relative flex-1">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" placeholder="Cari layanan..." class="w-full pl-12 pr-4 py-3 bg-transparent border-none focus:ring-0 text-slate-800 dark:text-slate-100 outline-none">
        </div>
        <div class="w-px bg-slate-200 dark:bg-slate-700 hidden md:block"></div>
        <select class="px-4 py-3 bg-transparent border-none focus:ring-0 text-slate-600 dark:text-slate-300 font-medium outline-none cursor-pointer">
            <option value="">Semua Kategori</option>
            <option value="Akademik">Akademik</option>
            <option value="Kepegawaian">Kepegawaian</option>
        </select>
    </div>

    <div>
        <div class="flex items-center gap-3 mb-6">
            <h2 class="text-xl font-bold">Semua Layanan</h2>
            <span class="bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 text-xs font-bold px-2.5 py-1 rounded-md">{{ count($layanan) }} layanan</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($layanan as $item)
                @include('user.components.service-card', ['item' => $item])
            @endforeach
        </div>
    </div>
</div>
@endsection