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
            <h2 class="text-5xl font-bold relative z-10">{{ $layananAktif }}</h2>
        </div>
    </div>

    @if(count($favorits) > 0)
    <div class="flex items-center justify-between mb-4 mt-8">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 text-orange-500 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            </div>
            <h3 class="text-xl font-bold">Layanan Favorit</h3>
        </div>
        <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 dark:bg-slate-800 dark:hover:bg-slate-700 px-4 py-2 rounded-full smooth-transition border border-blue-100 dark:border-slate-700">Lihat Semua &rarr;</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @foreach($favorits as $layanan)
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <form action="{{ route('favorit.toggle', $layanan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-yellow-400 hover:text-yellow-500 smooth-transition focus:outline-none">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </button>
                </form>
            </div>
            
            <h4 class="font-bold text-lg mb-1">{{ $layanan->nama }}</h4>
            
            <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 rounded-full {{ $layanan->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                <span class="text-xs font-bold {{ $layanan->is_active ? 'text-emerald-500' : 'text-slate-500' }}">{{ $layanan->is_active ? 'Aktif' : 'Nonaktif' }}</span>
            </div>
            
            <p class="text-sm text-slate-500 dark:text-slate-400 flex-1 mb-4">{{ $layanan->deskripsi }}</p>
            
            <div class="flex flex-wrap gap-2 mb-6">
                <span class="px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold rounded-full">{{ $layanan->nama_kategori ?? 'Umum' }}</span>
            </div>
            
            @if($layanan->is_active)
            <a href="{{ $layanan->url ? (str_starts_with($layanan->url, 'http') ? $layanan->url : 'https://' . $layanan->url) : '#' }}" 
            target="_blank" 
            class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm text-center rounded-xl shadow-md smooth-transition flex justify-center items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                Akses Layanan
            </a>
        @else
            <button disabled class="w-full py-3 bg-slate-200 dark:bg-slate-700 text-slate-400 dark:text-slate-500 font-bold text-sm text-center rounded-xl cursor-not-allowed">Layanan Tidak Tersedia</button>
@endif
        </div>
        @endforeach
    </div>
    @endif

    <div class="flex flex-col md:flex-row gap-4 mb-8">
        <input type="text" placeholder="Cari layanan..." class="flex-1 px-6 py-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button class="px-8 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition">Semua Kategori</button>
    </div>

    <div class="flex items-center gap-3 mb-6">
        <h3 class="text-xl font-bold">Semua Layanan</h3>
        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-400 text-xs font-bold rounded-full">{{ $totalLayanan }} layanan</span>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($layanans as $layanan)
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-blue-500/5 flex flex-col h-full smooth-transition">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                
                <form action="{{ route('favorit.toggle', $layanan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="focus:outline-none smooth-transition {{ in_array($layanan->id, $favoritIds) ? 'text-yellow-400 hover:text-yellow-500' : 'text-slate-300 hover:text-yellow-400 dark:text-slate-600 dark:hover:text-yellow-400' }}">
                        @if(in_array($layanan->id, $favoritIds))
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        @endif
                    </button>
                </form>
            </div>
            
            <h4 class="font-bold text-lg mb-1">{{ $layanan->nama }}</h4>
            
            <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 rounded-full {{ $layanan->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                <span class="text-xs font-bold {{ $layanan->is_active ? 'text-emerald-500' : 'text-slate-500' }}">{{ $layanan->is_active ? 'Aktif' : 'Nonaktif' }}</span>
            </div>
            
            <p class="text-sm text-slate-500 dark:text-slate-400 flex-1 mb-4">{{ $layanan->deskripsi }}</p>
            
            <div class="flex flex-wrap gap-2 mb-6">
                <span class="px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold rounded-full">{{ $layanan->nama_kategori ?? 'Umum' }}</span>
            </div>
            
            @if($layanan->is_active)
                <a href="{{ $layanan->url ? (str_starts_with($layanan->url, 'http') ? $layanan->url : 'https://' . $layanan->url) : '#' }}" 
                   target="_blank" 
                   class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm text-center rounded-xl shadow-md smooth-transition flex justify-center items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    Akses Layanan
                </a>
            @else
                <button disabled class="w-full py-3 bg-slate-200 dark:bg-slate-700 text-slate-400 dark:text-slate-500 font-bold text-sm text-center rounded-xl cursor-not-allowed">Layanan Tidak Tersedia</button>
            @endif
        </div>
        @endforeach
    </div>
@endsection