<?php

namespace App\Http\Controllers\user; 

use App\Http\Controllers\Controller; // 
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Simulasi data dari database agar Blade template lebih rapi (DRY)
        $layanan = [
            [
                'id' => 1, 'nama' => 'SID Kepegawaian', 'desc' => 'Sistem Informasi Data Kepegawaian',
                'status' => 'Aktif', 'kategori' => ['Kepegawaian', 'SID'], 'is_fav' => false, 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
            ],
            [
                'id' => 2, 'nama' => 'SID Akademik', 'desc' => 'Sistem Informasi Data Akademik',
                'status' => 'Aktif', 'kategori' => ['Akademik', 'SID'], 'is_fav' => true, 'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'
            ],
            [
                'id' => 3, 'nama' => 'Portal Mahasiswa', 'desc' => 'Portal untuk akses layanan mahasiswa',
                'status' => 'Aktif', 'kategori' => ['Akademik', 'TI'], 'is_fav' => true, 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'
            ],
            [
                'id' => 4, 'nama' => 'E-Learning', 'desc' => 'Platform pembelajaran online',
                'status' => 'Aktif', 'kategori' => ['Akademik', 'TI'], 'is_fav' => false, 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'
            ],
            [
                'id' => 5, 'nama' => 'SIMPEG', 'desc' => 'Sistem Informasi Manajemen Pegawai',
                'status' => 'Nonaktif', 'kategori' => ['Kepegawaian', 'SID'], 'is_fav' => false, 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
            ],
            [
                'id' => 6, 'nama' => 'Repository', 'desc' => 'Repository penelitian dan tugas akhir',
                'status' => 'Aktif', 'kategori' => ['Penelitian', 'Penelitian'], 'is_fav' => false, 'icon' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4'
            ],
            [
                'id' => 7, 'nama' => 'Email Polibatam', 'desc' => 'Email resmi Polibatam',
                'status' => 'Aktif', 'kategori' => ['Komunikasi', 'TI'], 'is_fav' => false, 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
            ],
            [
                'id' => 8, 'nama' => 'Perpustakaan Digital', 'desc' => 'Perpustakaan digital dan e-book',
                'status' => 'Aktif', 'kategori' => ['Akademik', 'Perpustakaan'], 'is_fav' => false, 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'
            ],
        ];

        return view('user.index', compact('layanan'));
    }
}