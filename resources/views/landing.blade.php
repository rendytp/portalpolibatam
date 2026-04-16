@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col">
    <nav class="flex justify-between items-center px-8 py-6 w-full max-w-7xl mx-auto">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg"></div>
            <span class="text-xl font-bold text-blue-700 dark:text-blue-400">Portal Polibatam</span>
        </div>
        <div class="flex items-center gap-6">
            <button @click="darkMode = !darkMode" class="p-2 rounded-full hover:bg-black/5 dark:hover:bg-white/10 smooth-transition">
                <svg x-show="!darkMode" class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
                <svg x-show="darkMode" x-cloak class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </button>
            <a href="{{ route('login') }}" class="font-medium hover:text-blue-600 dark:hover:text-blue-400 smooth-transition">Masuk</a>
            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-full font-medium shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-0.5 smooth-transition">Daftar</a>
        </div>
    </nav>

    <main class="flex-grow flex flex-col items-center justify-center text-center px-4 mt-10">
        <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
            Semua Layanan Polibatam <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">Dalam Satu Portal</span>
        </h1>
        <p class="text-lg text-slate-600 dark:text-slate-300 max-w-2xl mb-10">
            Akses seluruh sistem informasi dan layanan digital Politeknik Negeri Batam dengan mudah dan cepat. Tidak perlu lagi mengingat banyak URL.
        </p>
        <div class="flex gap-4 mb-20">
            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-full font-semibold shadow-lg shadow-blue-500/30 transform hover:-translate-y-1 smooth-transition flex items-center gap-2">
                Mulai Sekarang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
            <a href="{{ route('login') }}" class="bg-white dark:bg-slate-800 text-slate-800 dark:text-white border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500 px-8 py-3.5 rounded-full font-semibold shadow-sm transform hover:-translate-y-1 smooth-transition">
                Masuk ke Akun
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl w-full px-4 mb-20">
            <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-md p-8 rounded-3xl text-left shadow-xl border border-white/20 dark:border-slate-700 hover:-translate-y-2 smooth-transition">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Akses Cepat</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Akses semua layanan hanya dengan satu klik. Tandai layanan favorit untuk akses lebih cepat.</p>
            </div>
            <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-md p-8 rounded-3xl text-left shadow-xl border border-white/20 dark:border-slate-700 hover:-translate-y-2 smooth-transition">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Terorganisir</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Layanan terkelompok berdasarkan kategori. Buat kategori custom sesuai kebutuhan Anda.</p>
            </div>
            <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-md p-8 rounded-3xl text-left shadow-xl border border-white/20 dark:border-slate-700 hover:-translate-y-2 smooth-transition">
                <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/50 text-pink-600 dark:text-pink-400 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Aman & Terpercaya</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Portal resmi Polibatam dengan sistem autentikasi yang aman untuk melindungi data Anda.</p>
            </div>
        </div>
    </main>

    <footer class="py-8 text-center text-sm text-slate-500 dark:text-slate-400">
        &copy; 2026 Politeknik Negeri Batam. All rights reserved.
    </footer>
</div>
@endsection