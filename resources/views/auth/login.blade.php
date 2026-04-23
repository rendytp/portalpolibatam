@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 relative">
    <button @click="darkMode = !darkMode" class="absolute top-8 right-8 p-2 rounded-full bg-white/50 dark:bg-black/20 hover:bg-black/10 dark:hover:bg-white/10 smooth-transition">
        <svg x-show="!darkMode" class="w-5 h-5 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
    </button>

    <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="hidden lg:flex flex-col text-left pr-10">
               <div class="flex items-center gap-3 mb-10">
                    <img src="{{ asset('images/icon-logo.png') }}" alt="Logo Polibatam" class="h-14 w-auto object-contain">
                <span class="text-2xl font-bold text-blue-700 dark:text-blue-500">Portal Polibatam</span>
            </div>
            <h1 class="text-4xl font-bold mb-4">Selamat Datang Kembali</h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 mb-8">Akses semua layanan Polibatam dalam satu portal yang terintegrasi.</p>
            
            <ul class="space-y-6">
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center mt-1"><div class="w-2.5 h-2.5 rounded-full bg-blue-600 dark:bg-blue-400"></div></div>
                    <div><h4 class="font-bold">Akses Cepat</h4><p class="text-sm text-slate-500 dark:text-slate-400">Satu portal untuk semua layanan</p></div>
                </li>
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center mt-1"><div class="w-2.5 h-2.5 rounded-full bg-purple-600 dark:bg-purple-400"></div></div>
                    <div><h4 class="font-bold">Personalisasi</h4><p class="text-sm text-slate-500 dark:text-slate-400">Tandai layanan favorit Anda</p></div>
                </li>
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-pink-100 dark:bg-pink-900/50 flex items-center justify-center mt-1"><div class="w-2.5 h-2.5 rounded-full bg-pink-600 dark:bg-pink-400"></div></div>
                    <div><h4 class="font-bold">Aman & Terpercaya</h4><p class="text-sm text-slate-500 dark:text-slate-400">Portal resmi Polibatam</p></div>
                </li>
            </ul>
        </div>

        <div class="bg-white/80 dark:bg-slate-800/90 backdrop-blur-xl p-10 rounded-[2rem] shadow-2xl border border-white/20 dark:border-slate-700 w-full max-w-md mx-auto transform hover:-translate-y-1 smooth-transition">
            <h2 class="text-3xl font-bold mb-2">Masuk</h2>
            <p class="text-slate-500 dark:text-slate-400 mb-8 text-sm">Masukkan Akun Anda untuk melanjutkan</p>
            
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100/80 dark:bg-red-900/30 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 rounded-xl text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100/80 dark:bg-green-900/30 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-400 rounded-xl text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf 

                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input type="text" name="username" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none smooth-transition" placeholder="Masukkan username" required>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" name="password" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none smooth-transition" placeholder="Masukkan password" required>
                    </div>
                </div>
                
                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center text-sm cursor-pointer">
                        <input type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mr-2 bg-transparent dark:border-slate-600">
                        Ingat saya
                    </label>
                    <a href="#" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">Lupa password?</a>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-0.5 smooth-transition">
                    Masuk
                </button>
            </form>

            <p class="text-center mt-6 text-sm text-slate-600 dark:text-slate-400">
                Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-blue-600 dark:text-blue-400 hover:underline">Daftar sekarang</a>
            </p>
            
            <div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-700 text-center">
                <a href="{{ route('home') }}" class="inline-block mt-4 text-sm font-medium hover:text-blue-600 dark:hover:text-blue-400">&larr; Kembali ke beranda</a>
            </div>
        </div>
    </div>
</div>
@endsection