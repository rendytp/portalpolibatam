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
        $totalLayanan = DB::table('layanan')->where('is_active', 1)->count();
        $favoritCount = DB::table('user_favorit')->where('id_user', $user->id)->count();
        
        $layanans = DB::table('layanan')
            // PERBAIKAN: Disambungkan ke kategori.id
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id') 
            ->select('layanan.*', 'kategori.nama as nama_kategori')
            ->where('layanan.is_active', 1)
            ->get();

        return view('user.beranda', compact('user', 'totalLayanan', 'favoritCount', 'layanans'));
    }

    public function cari(Request $request)
    {
        $keyword = $request->input('q');
        
        $layanans = DB::table('layanan')
            // PERBAIKAN: Disambungkan ke kategori.id
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id')
            ->select('layanan.*', 'kategori.nama as nama_kategori')
            ->where('layanan.is_active', 1);

        if ($keyword) {
            // PERBAIKAN: Dibungkus agar pencarian tidak menampilkan layanan yang nonaktif
            $layanans = $layanans->where(function($query) use ($keyword) {
                $query->where('layanan.nama', 'like', "%{$keyword}%")
                      ->orWhere('layanan.deskripsi', 'like', "%{$keyword}%");
            });
        }

        $layanans = $layanans->get();
        
        return view('user.cari-layanan', compact('layanans', 'keyword'));
    }

    public function favorit()
    {
        $user = Auth::user();
        $layanans = DB::table('user_favorit')
            ->join('layanan', 'user_favorit.id_layanan', '=', 'layanan.id')
            // PERBAIKAN: Disambungkan ke kategori.id
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id')
            ->select('layanan.*', 'kategori.nama as nama_kategori')
            ->where('user_favorit.id_user', $user->id)
            ->get();

        return view('user.favorit', compact('layanans'));
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