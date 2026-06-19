<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http; // Wajib untuk cek URL

class LayananController extends Controller
{
    public function index()
    {
        $data = DB::table('layanan')
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id')
            ->select(
                'layanan.*',
                'kategori.nama as kategori'
            )
            ->latest('layanan.id')
            ->get();

        $kategori = DB::table('kategori')->get();

        return view('admin.layanan', compact('data', 'kategori'));
    }

    // FUNGSI PINTAR UNTUK CEK 3 STATUS OTOMATIS
    private function checkUrlStatus($url)
    {
        try {
            // Coba buka URL dengan batas waktu 4 detik
            $response = Http::timeout(4)->get($url);

            if ($response->successful()) {
                return 1; // STATUS 1: Aktif (Sukses 200)
            } elseif ($response->serverError()) {
                return 2; // STATUS 2: Gangguan (Error 500 Server Down)
            } else {
                return 0; // STATUS 0: Non-aktif (Error 404 Not Found)
            }
        } catch (\Exception $e) {
            // Jika koneksi mati total, ditolak, atau timeout
            return 2; // Anggap Sedang Gangguan
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama' => 'required',
            'url' => 'required|url' // Diperbaiki: Wajib format URL
        ]);

        $url = $request->url;
        
        // Cek status otomatis berdasarkan URL yang diketik
        $statusOtomatis = $this->checkUrlStatus($url);

        DB::table('layanan')->insert([
            'id_kategori' => $request->id_kategori,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'url' => $url,
            'is_active' => $statusOtomatis, // 1 (Aktif), 2 (Gangguan), 0 (Non-aktif)
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Layanan ditambahkan & Status dicek otomatis!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama' => 'required',
            'url' => 'required|url'
        ]);

        $url = $request->url;

        // Cek ulang status otomatis setiap kali di-update
        $statusOtomatis = $this->checkUrlStatus($url);

        DB::table('layanan')
            ->where('id', $id)
            ->update([
                'id_kategori' => $request->id_kategori,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'url' => $url,
                'is_active' => $statusOtomatis,
                'updated_at' => now()
            ]);

        return back()->with('success', 'Layanan diupdate & Status diperbarui otomatis!');
    }

    public function destroy($id)
    {
        DB::table('layanan')
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Berhasil hapus layanan');
    }
}