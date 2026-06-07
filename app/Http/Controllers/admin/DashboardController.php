<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // =====================
        // CARD STATISTIK
        // =====================

        $totalLayanan = DB::table('layanan')->count();

        $totalKategori = DB::table('kategori')->count();

        $totalUser = DB::table('users')->count();

        $layananBulanIni = DB::table('layanan')
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        $layananAktif = DB::table('layanan')
            ->where('is_active', 1)
            ->count();

        $userMingguIni = DB::table('users')
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->count();

        $userAktif = DB::table('users')->count();

        $persentaseUser = $totalUser > 0
            ? round(($userAktif / $totalUser) * 100)
            : 0;

        // =====================
        // LINE CHART
        // =====================

        $pertumbuhanUser = [];

        for ($bulan = 1; $bulan <= 6; $bulan++) {

            $pertumbuhanUser[] = DB::table('users')
                ->whereMonth('created_at', $bulan)
                ->count();
        }

        // =====================
        // PIE CHART
        // =====================

        $layananChart = DB::table('kategori')
        ->leftJoin('layanan', 'kategori.id', '=', 'layanan.id_kategori')
        ->select(
            'kategori.nama',
            DB::raw('COUNT(layanan.id) as total')
        )
        ->groupBy('kategori.nama')
        ->get();
        return view('admin.dashboard', compact(
            'totalLayanan',
            'totalKategori',
            'totalUser',
            'userAktif',
            'layananBulanIni',
            'layananAktif',
            'userMingguIni',
            'persentaseUser',
            'pertumbuhanUser',
            'layananChart'
        ));
    }
}
