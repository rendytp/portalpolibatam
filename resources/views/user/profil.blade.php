@extends('layouts.user.app')

@section('content')
    <div class="mb-10 flex items-center gap-4">
        <div class="w-12 h-12 bg-gradient-to-r from-rose-500 to-pink-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-rose-500/30">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
        </div>
        <div>
            <h1 class="text-3xl font-bold">Profil Saya</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Kelola informasi akun dan keamanan Anda</p>
        </div>
    </div>

    <div class="max-w-3xl space-y-8">
        <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700">
            <h3 class="text-xl font-bold mb-6">Informasi Profil</h3>
            <div class="mb-5">
                <label class="block text-sm font-bold mb-2">Username</label>
                <input type="text" value="{{ $user->username }}" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 cursor-not-allowed text-slate-500" disabled>
            </div>
            <div class="mb-8">
                <label class="block text-sm font-bold mb-2">Role / Jabatan</label>
                <input type="text" value="{{ $user->role }}" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 cursor-not-allowed text-slate-500" disabled>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700">
            <h3 class="text-xl font-bold mb-6">Ubah Password</h3>
            <form>
                <div class="mb-5">
                    <label class="block text-sm font-bold mb-2">Password Baru</label>
                    <input type="password" placeholder="Minimal 6 karakter" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <button type="button" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg smooth-transition">
                    Simpan Password Baru
                </button>
            </form>
        </div>
    </div>
@endsection