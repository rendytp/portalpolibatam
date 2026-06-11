<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // 1. Perhitungan statistik kartu widget atas
        $totalLayanan = DB::table('layanan')->count(); // Hitung semua katalog layanan
        $layananAktif = DB::table('layanan')->where('is_active', 1)->count(); // Hanya yang aktif
        $favoritCount = DB::table('user_favorit')->where('id_user', $user->id)->count(); // Jumlah favorit user ini
        
        // 2. Ambil SEMUA layanan (termasuk yang nonaktif seperti SIMPEG agar muncul di grid bawah)
        $layanans = DB::table('layanan')
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id') 
            ->select('layanan.*', 'kategori.nama as nama_kategori')
            ->get();

        // 3. Ambil data khusus LAYANAN FAVORIT untuk seksi bagian atas Gambar 2
        $favorits = DB::table('user_favorit')
            ->join('layanan', 'user_favorit.id_layanan', '=', 'layanan.id')
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id')
            ->select('layanan.*', 'kategori.nama as nama_kategori')
            ->where('user_favorit.id_user', $user->id)
            ->get();

        // 4. Ambil semua ID layanan favorit user ini dalam bentuk Array untuk penanda warna bintang
        $favoritIds = DB::table('user_favorit')
            ->where('id_user', $user->id)
            ->pluck('id_layanan')
            ->toArray();

        return view('user.beranda', compact('user', 'totalLayanan', 'layananAktif', 'favoritCount', 'layanans', 'favorits', 'favoritIds'));
    }

    public function cari(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->input('q');
        
        $layanans = DB::table('layanan')
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id')
            ->select('layanan.*', 'kategori.nama as nama_kategori');

        if ($keyword) {
            $layanans = $layanans->where(function($query) use ($keyword) {
                $query->where('layanan.nama', 'like', "%{$keyword}%")
                      ->orWhere('layanan.deskripsi', 'like', "%{$keyword}%");
            });
        }

        $layanans = $layanans->get();

        // Ambil data ID favorit agar icon bintang tetap bekerja dengan baik di halaman pencarian
        $favoritIds = DB::table('user_favorit')
            ->where('id_user', $user->id)
            ->pluck('id_layanan')
            ->toArray();
        
        return view('user.cari-layanan', compact('layanans', 'keyword', 'favoritIds'));
    }

    public function favorit()
    {
        $user = Auth::user();
        
        $layanans = DB::table('user_favorit')
            ->join('layanan', 'user_favorit.id_layanan', '=', 'layanan.id')
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id')
            ->select('layanan.*', 'kategori.nama as nama_kategori')
            ->where('user_favorit.id_user', $user->id)
            ->get();

        $favoritIds = $layanans->pluck('id')->toArray();

        return view('user.favorit', compact('layanans', 'favoritIds'));
    }

    // FUNGSI BARU: Menangani aksi klik tombol bintang (Bookmark / Un-bookmark)
    public function toggleFavorit($id)
    {
        $user = Auth::user();
        
        // Cek apakah layanan ini sudah ditandai favorit oleh user terkait
        $isFavorit = DB::table('user_favorit')
            ->where('id_user', $user->id)
            ->where('id_layanan', $id)
            ->first();

        if ($isFavorit) {
            // Jika sudah ada, hapus dari daftar favorit saat bintang diklik kembali
            DB::table('user_favorit')
                ->where('id_user', $user->id)
                ->where('id_layanan', $id)
                ->delete();
        } else {
            // Jika belum ada, tambahkan baris baru ke tabel user_favorit
            DB::table('user_favorit')->insert([
                'id_user' => $user->id,
                'id_layanan' => $id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Kembalikan user ke halaman sebelumnya dengan data terperbarui
        return back();
    }

    public function customLinks()
    {
        $user = Auth::user();
        $links = DB::table('user_custom_link')->where('id_user', $user->id)->orderBy('created_at', 'desc')->get();
        
        return view('user.custom-links', compact('links'));
    }

    public function profil()
    {
        $user = Auth::user();
        
        return view('user.profil', compact('user'));
    }
}