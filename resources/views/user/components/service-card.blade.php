<div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-600 transition-all duration-300 flex flex-col h-full group">
    
    <div class="flex justify-between items-start mb-4">
        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:scale-110 smooth-transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path></svg>
        </div>
        <button class="text-slate-300 dark:text-slate-600 hover:text-orange-400 dark:hover:text-orange-400 smooth-transition">
            <svg class="w-6 h-6 {{ $item['is_fav'] ? 'text-orange-400 fill-current' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
        </button>
    </div>

    <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-2">{{ $item['nama'] }}</h3>
    
    <div class="mb-3">
        @if($item['status'] == 'Aktif')
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 uppercase tracking-wide">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
            </span>
        @else
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 dark:bg-slate-700 dark:text-slate-400 uppercase tracking-wide">
                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Nonaktif
            </span>
        @endif
    </div>

    <p class="text-sm text-slate-500 dark:text-slate-400 mb-6 flex-grow">{{ $item['desc'] }}</p>

    <div class="flex flex-wrap gap-2 mb-6">
        @foreach($item['kategori'] as $kat)
            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-300 text-xs font-medium rounded-md">{{ $kat }}</span>
        @endforeach
    </div>

    @if($item['status'] == 'Aktif')
        <a href="#" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl flex items-center justify-center gap-2 shadow-md shadow-blue-500/20 transform hover:-translate-y-0.5 smooth-transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            Akses Layanan
        </a>
    @else
        <button disabled class="w-full py-3 bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 text-sm font-semibold rounded-xl cursor-not-allowed border border-slate-200 dark:border-slate-700">
            Layanan Tidak Tersedia
        </button>
    @endif
</div>