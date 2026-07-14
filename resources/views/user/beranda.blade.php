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
        <a href="{{ route('favorit') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 dark:bg-slate-800 dark:hover:bg-slate-700 px-4 py-2 rounded-full smooth-transition border border-blue-100 dark:border-slate-700">Lihat Semua &rarr;</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @foreach($favorits as $layanan)
        @php
            // 1. Set nilai default (jika kategori tidak dikenali)
            $bgColorClass = 'bg-blue-600'; 
            $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>';

            // 2. Logika penentuan ikon dan warna berdasarkan kategori
            switch(strtolower($layanan->nama_kategori)) {
                case 'akademik':
                    $bgColorClass = 'bg-blue-600';
                    $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>'; // Toga Wisuda
                    break;
                case 'penelitian':
                    $bgColorClass = 'bg-purple-600';
                    $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8m-4 2v5m-1.618 3a2.001 2.001 0 01-3.266 0 2.001 2.001 0 011.642-3.155L12 11l2.242 1.845a2.001 2.001 0 011.642 3.155 2.001 2.001 0 01-3.266 0"/></svg>'; // Tabung Kimia
                    break;
                case 'fasilitas digital':
                    $bgColorClass = 'bg-teal-600';
                    $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>'; // Monitor Komputer
                    break;
                case 'urusan kepegawaian':
                    $bgColorClass = 'bg-orange-600';
                    $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>'; // User / ID Card
                    break;
                case 'komunikasi':
                    $bgColorClass = 'bg-pink-600';
                    $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>'; // Balon Chat
                    break;
            }
        @endphp

        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-blue-500/5 flex flex-col h-full smooth-transition">
            <div class="flex justify-between items-start mb-4">
                
                <div class="w-12 h-12 rounded-xl {{ $bgColorClass }} text-white flex items-center justify-center">
                    {!! $iconSvg !!}
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
        @endforeach
    </div>
    @endif

    <div class="flex items-center gap-3 mb-6 mt-4">
        <h3 class="text-xl font-bold">Semua Layanan</h3>
        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-400 text-xs font-bold rounded-full">{{ $totalLayanan }} layanan</span>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($layanans as $layanan)
        @php
            // 1. Set nilai default (jika kategori tidak dikenali)
            $bgColorClass = 'bg-blue-600'; 
            $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>';

            // 2. Logika penentuan ikon dan warna berdasarkan kategori
            switch(strtolower($layanan->nama_kategori)) {
                case 'akademik':
                    $bgColorClass = 'bg-blue-600';
                    $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>'; // Toga Wisuda
                    break;
                case 'penelitian':
                    $bgColorClass = 'bg-purple-600';
                    $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8m-4 2v5m-1.618 3a2.001 2.001 0 01-3.266 0 2.001 2.001 0 011.642-3.155L12 11l2.242 1.845a2.001 2.001 0 011.642 3.155 2.001 2.001 0 01-3.266 0"/></svg>'; // Tabung Kimia
                    break;
                case 'fasilitas digital':
                    $bgColorClass = 'bg-teal-600';
                    $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>'; // Monitor Komputer
                    break;
                case 'urusan kepegawaian':
                    $bgColorClass = 'bg-orange-600';
                    $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>'; // User / ID Card
                    break;
                case 'komunikasi':
                    $bgColorClass = 'bg-pink-600';
                    $iconSvg = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>'; // Balon Chat
                    break;
            }
        @endphp

    <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:shadow-blue-500/5 flex flex-col h-full smooth-transition">
        <div class="flex justify-between items-start mb-4">
            
            <div class="w-12 h-12 rounded-xl {{ $bgColorClass }} text-white flex items-center justify-center">
                {!! $iconSvg !!}
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
        @endforeach
    </div>
@endsection