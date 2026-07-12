<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index() 
    {
        $user = Auth::user();
        
        $totalLayanan = DB::table('layanan')->count(); 
        $layananAktif = DB::table('layanan')->where('is_active', 1)->count(); 
        $favoritCount = DB::table('user_favorit')->where('id_user', $user->id)->count(); 
        
        $layanans = DB::table('layanan')
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id') 
            ->select('layanan.*', 'kategori.nama as nama_kategori')
            ->get();

        $favorits = DB::table('user_favorit')
            ->join('layanan', 'user_favorit.id_layanan', '=', 'layanan.id')
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id')
            ->select('layanan.*', 'kategori.nama as nama_kategori')
            ->where('user_favorit.id_user', $user->id)
            ->get();

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
        $kategoriId = $request->input('kategori'); // Menangkap input dari dropdown
        
        // Mengambil semua data kategori untuk opsi dropdown filter
        $kategoris = DB::table('kategori')->get();

        $layanans = DB::table('layanan')
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id')
            ->select('layanan.*', 'kategori.nama as nama_kategori');

        // Filter berdasarkan Input Text (Keyword)
        if ($keyword) {
            $layanans = $layanans->where(function($query) use ($keyword) {
                $query->where('layanan.nama', 'like', "%{$keyword}%")
                      ->orWhere('layanan.deskripsi', 'like', "%{$keyword}%");
            });
        }

        // Filter berdasarkan Dropdown Kategori
        if ($kategoriId) {
            $layanans = $layanans->where('layanan.id_kategori', $kategoriId);
        }

        $layanans = $layanans->get();

        $favoritIds = DB::table('user_favorit')
            ->where('id_user', $user->id)
            ->pluck('id_layanan')
            ->toArray();
        
        // Pass $kategoris ke view
        return view('user.cari-layanan', compact('layanans', 'keyword', 'favoritIds', 'kategoris'));
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

    public function toggleFavorit($id)
    {
        $user = Auth::user();
        
        $isFavorit = DB::table('user_favorit')
            ->where('id_user', $user->id)
            ->where('id_layanan', $id)
            ->first();

        if ($isFavorit) {
            DB::table('user_favorit')->where('id_user', $user->id)->where('id_layanan', $id)->delete();
        } else {
            DB::table('user_favorit')->insert([
                'id_user' => $user->id,
                'id_layanan' => $id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return back();
    }

    // ==========================================
    // FUNGSI UNTUK CUSTOM LINKS
    // ==========================================
    
    public function customLinks()
    {
        $user = Auth::user();
        $links = DB::table('user_custom_link')
            ->where('id_user', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('user.custom-links', compact('links'));
    }

    public function storeCustomLink(Request $request)
    {
        $request->validate([
            'judul_link' => [
                'required', 
                'string', 
                'max:255',
                \Illuminate\Validation\Rule::unique('user_custom_link')->where(function ($query) {
                    return $query->where('id_user', auth()->id());
                })
            ],
            'url_link' => 'required|url',
        ], [
            'judul_link.unique' => 'Judul link ini sudah pernah Anda gunakan!', 
        ]);

        try {
            DB::table('user_custom_link')->insert([
                'id_user' => Auth::user()->id,
                'judul_link' => $request->judul_link,
                'url_link' => $request->url_link,
                'deskripsi' => $request->deskripsi, 
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            return back()->with('success', 'Link berhasil ditambahkan!');

        } catch (\Illuminate\Database\QueryException $e) {
            throw $e; 
        }
    }

    public function updateCustomLink(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'judul_link' => [
                'required', 
                'string', 
                'max:255',
                \Illuminate\Validation\Rule::unique('user_custom_link', 'judul_link')
                    ->where('id_user', $user->id)
                    ->ignore($id)
            ],
            'url_link' => 'required|url',
        ], [
            'judul_link.unique' => 'Judul link ini sudah pernah Anda gunakan!', 
        ]);

    try {
        DB::table('user_custom_link')
            ->where('id', $id)
            ->where('id_user', $user->id) 
            ->update([
                'judul_link' => $request->judul_link,
                'url_link' => $request->url_link,
                'deskripsi' => $request->deskripsi, 
                'updated_at' => now()
            ]);

        return back()->with('success', 'Link berhasil diperbarui!');
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e;
        }
    }

    public function deleteCustomLink($id)
    {
        DB::table('user_custom_link')
            ->where('id', $id)
            ->where('id_user', Auth::user()->id) 
            ->delete();

        return back()->with('success', 'Link berhasil dihapus!');
    }

    // ==========================================
    // FUNGSI UNTUK PROFIL SAYA
    // ==========================================

    public function profil()
    {
        $user = Auth::user();
        return view('user.profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        ]);

        DB::table('users')->where('id', $user->id)->update([
            'username' => $request->username,
            'updated_at' => now()
        ]);

        return back()->with('success', 'Username berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'new_password.min' => 'Password baru minimal harus 6 karakter.'
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.']);
        }

        DB::table('users')->where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}