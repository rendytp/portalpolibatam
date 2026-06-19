@extends('layouts.user.app')

@section('content')
    <div class="mb-8 flex items-center gap-4">
        <div class="w-12 h-12 bg-gradient-to-br from-fuchsia-500 to-pink-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-pink-500/30">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <div>
            <h1 class="text-3xl font-bold">Cari Layanan</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Temukan layanan yang Anda butuhkan dengan cepat</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto mb-10 text-center">
        <form action="{{ route('cari') }}" method="GET">
            <input type="text" name="q" value="{{ $keyword }}" placeholder="Cari berdasarkan nama, kategori, atau deskripsi..." class="w-full px-8 py-5 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-pink-500 text-lg transition text-center shadow-sm">
        </form>
        <div class="flex items-center mt-6 text-sm text-slate-500 justify-start pl-2">
            <span>Ditemukan <span class="font-bold text-pink-600">{{ count($layanans) }}</span> layanan</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($layanans as $layanan)
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-pink-500/5 flex flex-col h-full smooth-transition">
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
                @if($layanan->is_active == 1)
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="text-xs font-bold text-emerald-500">Aktif</span>
                @elseif($layanan->is_active == 2)
                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                    <span class="text-xs font-bold text-orange-500">Sedang Gangguan</span>
                @else
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    <span class="text-xs font-bold text-red-500">Non-aktif</span>
                @endif
            </div>
            
            <p class="text-sm text-slate-500 dark:text-slate-400 flex-1 mb-4">{{ $layanan->deskripsi }}</p>
            
            <div class="flex flex-wrap gap-2 mb-6">
                <span class="px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold rounded-full">{{ $layanan->nama_kategori ?? 'Umum' }}</span>
            </div>
            
            @if($layanan->is_active == 1)
                <a href="{{ $layanan->url ? (str_starts_with($layanan->url, 'http') ? $layanan->url : 'https://' . $layanan->url) : '#' }}" 
                   target="_blank" 
                   class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm text-center rounded-xl shadow-md smooth-transition flex justify-center items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    Akses Layanan
                </a>
            @elseif($layanan->is_active == 2)
                <button disabled class="w-full py-3 bg-orange-50 dark:bg-orange-900/20 text-orange-500 dark:text-orange-400 font-bold text-sm text-center rounded-xl cursor-not-allowed border border-orange-200 dark:border-orange-800">Sedang Gangguan</button>
            @else
                <button disabled class="w-full py-3 bg-red-50 dark:bg-red-900/20 text-red-400 dark:text-red-300 font-bold text-sm text-center rounded-xl cursor-not-allowed border border-red-200 dark:border-red-800">Layanan Tidak Tersedia</button>
            @endif
        </div>
        @empty
        <div class="col-span-full text-center py-10 text-slate-500">Layanan tidak ditemukan.</div>
        @endforelse
    </div>
@endsection