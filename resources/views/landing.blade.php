@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col relative bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg-polibatam.jpeg') }}');">
    
    <div class="absolute inset-0 bg-slate-900/70 z-0"></div>

    <div class="relative z-10 flex flex-col min-h-screen">
        
        <nav class="flex justify-between items-center px-8 py-6 w-full max-w-7xl mx-auto">
            <div class="flex items-center gap-2 mb-10">
                    <img src="{{ asset('images/icon-logo.png') }}" alt="Logo Polibatam" class="h-14 w-auto object-contain">
                <span class="text-xl font-bold text-white">Portal Polibatam</span>
            </div>
            <div class="flex items-center gap-6">
                <a href="{{ route('login') }}" class="font-medium text-white hover:text-blue-300 smooth-transition">Masuk</a>
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-full font-medium shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-0.5 smooth-transition">Daftar</a>
            </div>
        </nav>

        <main class="flex-grow flex flex-col items-center justify-center text-center px-4 mt-4">
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight text-white">
                Semua Layanan Polibatam <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">Dalam Satu Portal</span>
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mb-10">
                Akses seluruh sistem informasi dan layanan digital Politeknik Negeri Batam dengan mudah dan cepat. Tidak perlu lagi mengingat banyak URL.
            </p>
            <div class="flex gap-4 mb-20">
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-full font-semibold shadow-lg shadow-blue-500/30 transform hover:-translate-y-1 smooth-transition flex items-center gap-2">
                    Mulai Sekarang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="{{ route('login') }}" class="bg-white/10 backdrop-blur-md text-white border border-white/20 hover:bg-white/20 px-8 py-3.5 rounded-full font-semibold shadow-sm transform hover:-translate-y-1 smooth-transition">
                    Masuk ke Akun
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl w-full px-4 mb-20">
                <div class="bg-slate-900/40 backdrop-blur-lg p-8 rounded-3xl text-left shadow-2xl border border-white/10 hover:-translate-y-2 smooth-transition">
                    <div class="w-12 h-12 bg-blue-500/20 text-blue-400 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Akses Cepat</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Akses semua layanan hanya dengan satu klik. Tandai layanan favorit untuk akses lebih cepat.</p>
                </div>
                <div class="bg-slate-900/40 backdrop-blur-lg p-8 rounded-3xl text-left shadow-2xl border border-white/10 hover:-translate-y-2 smooth-transition">
                    <div class="w-12 h-12 bg-purple-500/20 text-purple-400 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Terorganisir</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Layanan terkelompok berdasarkan kategori. Buat kategori custom sesuai kebutuhan Anda.</p>
                </div>
                <div class="bg-slate-900/40 backdrop-blur-lg p-8 rounded-3xl text-left shadow-2xl border border-white/10 hover:-translate-y-2 smooth-transition">
                    <div class="w-12 h-12 bg-pink-500/20 text-pink-400 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Aman & Terpercaya</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Portal resmi Polibatam dengan sistem autentikasi yang aman untuk melindungi data Anda.</p>
                </div>
            </div>
        </main>

        <footer class="py-8 text-center text-sm text-slate-400">
            &copy; 2026 Politeknik Negeri Batam. All rights reserved.
        </footer>
    </div>
</div>
@endsection