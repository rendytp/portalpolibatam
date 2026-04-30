<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 📊 TOTAL
        $totalLayanan = DB::table('layanan')->count();
        $totalKategori = DB::table('kategori')->count();
        $totalUser = DB::table('users')->count();

        // 🔥 Layanan bulan ini
        $layananBulanIni = DB::table('layanan')
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        $layananAktif = DB::table('layanan')
            ->where('is_active', 1)
            ->count();

        // 🔥 User minggu ini
        $userMingguIni = DB::table('users')
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->count();

        // 🔥 User aktif (sementara semua user)
        $userAktif = DB::table('users')->count();

        // 🔥 Persentase user aktif
        $persentaseUser = $totalUser > 0
            ? round(($userAktif / $totalUser) * 100)
            : 0;

        return view('admin.dashboard', compact(
            'totalLayanan',
            'totalKategori',
            'totalUser',
            'userAktif',
            'layananBulanIni',
            'layananAktif',
            'userMingguIni',
            'persentaseUser'
        ));
    }
}
