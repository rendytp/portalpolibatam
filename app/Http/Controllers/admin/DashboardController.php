<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $sekarang = Carbon::now();

        // ── STATISTIK LAYANAN ──
        $totalLayanan    = DB::table('layanan')->count();
        $layananAktif    = DB::table('layanan')->where('is_active', 1)->count();
        $layananBulanIni = DB::table('layanan')
            ->whereYear('created_at', $sekarang->year)
            ->whereMonth('created_at', $sekarang->month)
            ->count();

        // ── STATISTIK USER ──
        $totalUser    = DB::table('users')->count();
        $userAktif    = DB::table('users')->where('role', 'Staff')->count();
        $userMingguIni = DB::table('users')
            ->whereBetween('created_at', [
                $sekarang->startOfWeek()->copy(),
                $sekarang->endOfWeek()->copy(),
            ])
            ->count();

        $persentaseUser = $totalUser > 0
            ? round(($userAktif / $totalUser) * 100)
            : 0;

        // ── LABEL BULAN DINAMIS (sampai bulan sekarang) ──
        $namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $bulanSekarang = $sekarang->month; // 1–12

        $labelBulan     = [];
        $pertumbuhanUser = [];

        for ($i = 1; $i <= $bulanSekarang; $i++) {
            $labelBulan[] = $namaBulan[$i - 1];

            $jumlah = DB::table('users')
                ->whereYear('created_at', $sekarang->year)
                ->whereMonth('created_at', $i)
                ->count();

            $pertumbuhanUser[] = $jumlah;
        }

        // ── PIE CHART LAYANAN PER KATEGORI ──
        $layananChart = DB::table('layanan')
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id')
            ->select('kategori.nama', DB::raw('COUNT(layanan.id) as total'))
            ->groupBy('kategori.nama')
            ->get();

        return view('admin.dashboard', compact(
            'totalLayanan',
            'layananAktif',
            'layananBulanIni',
            'totalUser',
            'userAktif',
            'userMingguIni',
            'persentaseUser',
            'labelBulan',
            'pertumbuhanUser',
            'layananChart'
        ));
    }
}
