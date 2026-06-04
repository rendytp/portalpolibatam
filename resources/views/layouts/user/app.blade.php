<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Polibatam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { colors: { primary: '#4f46e5', secondary: '#ec4899' } } }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .smooth-transition { transition: all 0.3s ease-in-out; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 antialiased smooth-transition">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-72 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 flex flex-col smooth-transition">
            <div class="h-20 flex items-center px-8 border-b border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/icon-logo.png') }}" alt="Logo" class="h-8">
                    <span class="text-xl font-bold text-blue-600 dark:text-blue-400">Portal Polibatam</span>
                </div>
            </div>

            <div class="px-6 py-6 flex-1 overflow-y-auto">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 px-2">Menu Navigasi</p>
                <nav class="space-y-2">
                    <a href="{{ route('beranda') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('beranda') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/30' : 'text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700' }} smooth-transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="font-medium">Beranda</span>
                    </a>
                    <a href="{{ route('cari') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('cari') ? 'bg-gradient-to-r from-fuchsia-500 to-pink-500 text-white shadow-md shadow-pink-500/30' : 'text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700' }} smooth-transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="font-medium">Cari Layanan</span>
                    </a>
                    <a href="{{ route('favorit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('favorit') ? 'bg-gradient-to-r from-orange-400 to-orange-500 text-white shadow-md shadow-orange-500/30' : 'text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700' }} smooth-transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        <span class="font-medium">Favorit Saya</span>
                    </a>
                    <a href="{{ route('custom.links') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('custom.links') ? 'bg-gradient-to-r from-emerald-400 to-emerald-500 text-white shadow-md shadow-emerald-500/30' : 'text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700' }} smooth-transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        <span class="font-medium">Custom Links</span>
                    </a>
                    <a href="{{ route('profil') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('profil') ? 'bg-gradient-to-r from-rose-500 to-pink-500 text-white shadow-md shadow-rose-500/30' : 'text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700' }} smooth-transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span class="font-medium">Profil Saya</span>
                    </a>
                </nav>

                <div class="mt-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-2xl border border-blue-100 dark:border-blue-800/50">
                    <div class="flex items-center gap-2 mb-2 text-blue-700 dark:text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        <span class="font-bold text-sm">Tips</span>
                    </div>
                    <p class="text-xs text-blue-600 dark:text-blue-300">Tandai layanan yang sering digunakan sebagai favorit untuk akses lebih cepat!</p>
                </div>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="h-20 bg-white/80 dark:bg-slate-800/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-700 flex items-center justify-between px-8 z-10">
                <div class="flex-1"></div>
                
                <div class="flex items-center gap-6">
                    <button @click="darkMode = !darkMode" class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 smooth-transition">
                        <svg x-show="!darkMode" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="darkMode" x-cloak class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>

                    <div x-data="{ openProfile: false }" class="relative">
                        <button @click="openProfile = !openProfile" @click.away="openProfile = false" class="flex items-center gap-3 p-1 pr-3 rounded-full bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 hover:shadow-md smooth-transition">
                            <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
                                {{ substr(Auth::user()->username, 0, 1) }}
                            </div>
                            <span class="text-sm font-semibold">{{ Auth::user()->username }}</span>
                        </button>

                        <div x-show="openProfile" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 transform"
                             x-transition:enter-end="opacity-100 scale-100 transform"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100 transform"
                             x-transition:leave-end="opacity-0 scale-95 transform"
                             class="absolute right-0 mt-3 w-56 bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 overflow-hidden z-50">
                            <div class="p-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                                <p class="font-bold text-slate-800 dark:text-white">{{ Auth::user()->username }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ Auth::user()->role }}</p>
                            </div>
                            <div class="p-2">
                                <a href="{{ route('profil') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-xl transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Profil Saya
                                </a>
                                <form method="POST" action="#">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition mt-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 relative">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>