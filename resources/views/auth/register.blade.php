@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 relative">
    <button @click="darkMode = !darkMode" class="absolute top-8 right-8 p-2 rounded-full bg-white/50 dark:bg-black/20 hover:bg-black/10 dark:hover:bg-white/10 smooth-transition">
        <svg x-show="!darkMode" class="w-5 h-5 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
        </svg>
        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
    </button>

    <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="hidden lg:flex flex-col text-left pr-10">
            <div class="flex items-center gap-3 mb-10">
                    <img src="{{ asset('images/icon-logo.png') }}" alt="Logo Polibatam" class="h-14 w-auto object-contain">
                <span class="text-2xl font-bold text-blue-700 dark:text-blue-500">Portal Polibatam</span>
            </div>
            <h1 class="text-4xl font-bold mb-4">Bergabung dengan Portal</h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 mb-8">Buat akun untuk mengakses semua layanan Politeknik Negeri Batam dengan mudah.</p>

            <ul class="space-y-6">
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center mt-1">
                        <div class="w-2.5 h-2.5 rounded-full bg-blue-600 dark:bg-blue-400"></div>
                    </div>
                    <div>
                        <h4 class="font-bold">Akses Terpusat</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Temukan semua kebutuhan akademik Anda di satu pintu.</p>
                    </div>
                </li>
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center mt-1">
                        <div class="w-2.5 h-2.5 rounded-full bg-purple-600 dark:bg-purple-400"></div>
                    </div>
                    <div>
                        <h4 class="font-bold">Mudah Digunakan</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Interface yang intuitif</p>
                    </div>
                </li>
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-pink-100 dark:bg-pink-900/50 flex items-center justify-center mt-1">
                        <div class="w-2.5 h-2.5 rounded-full bg-pink-600 dark:bg-pink-400"></div>
                    </div>
                    <div>
                        <h4 class="font-bold">Selalu Update</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Layanan terbaru tersedia</p>
                    </div>
                </li>
            </ul>
        </div>

        <div class="bg-white/80 dark:bg-slate-800/90 backdrop-blur-xl p-10 rounded-[2rem] shadow-2xl border border-white/20 dark:border-slate-700 w-full max-w-md mx-auto transform hover:-translate-y-1 smooth-transition">
            <h2 class="text-3xl font-bold mb-2">Daftar Akun</h2>
            <p class="text-slate-500 dark:text-slate-400 mb-6 text-sm">Isi form di bawah untuk membuat akun baru</p>
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100/80 dark:bg-red-900/30 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 rounded-xl">
                    <ul class="list-disc list-inside text-sm font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf 

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input type="text" name="username" value="{{ old('username') }}" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none smooth-transition" placeholder="Pilih username" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input type="password" name="password" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none smooth-transition" placeholder="Minimal 6 karakter" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input type="password" name="password_confirmation" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none smooth-transition" placeholder="Ulangi password" required>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2">Role / Jabatan</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <select name="role" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none appearance-none smooth-transition">
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Staff" selected>Staff</option>
                            <option value="Dosen">Dosen</option>
                            <option value="Laboran">Laboran</option>
                            <option value="TU">TU</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-0.5 smooth-transition">
                    Daftar
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-slate-600 dark:text-slate-400">
                    Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-blue-600 dark:text-blue-400 hover:underline">Masuk sekarang</a>
                </p>
                <a href="{{ route('home') }}" class="inline-block mt-6 text-sm font-medium hover:text-blue-600 dark:hover:text-blue-400">&larr; Kembali ke beranda</a>
            </div>
        </div>
    </div>
</div>
@endsection