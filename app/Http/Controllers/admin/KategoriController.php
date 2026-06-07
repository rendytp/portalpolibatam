<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        // Mengambil semua data kategori diurutkan dari yang terbaru berdasarkan ID
        $data = DB::table('kategori')
            ->latest('id')
            ->get();

        // Mengembalikan view khusus admin kategori dengan membawa data kategori
        return view('admin.kategori', compact('data'));
    }

    public function store(Request $request)
    {
        // Validasi input nama kategori
        $request->validate([
            'nama' => 'required'
        ]);

        // Insert data ke tabel kategori
        DB::table('kategori')->insert([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi, // Opsional, sesuaikan dengan form Anda
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with(
            'success',
            'Berhasil tambah kategori'
        );
    }

    public function update(Request $request, $id)
    {
        // Validasi input nama kategori saat update
        $request->validate([
            'nama' => 'required'
        ]);

        // Update data berdasarkan ID kategori
        DB::table('kategori')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'updated_at' => now()
            ]);

        return back()->with(
            'success',
            'Berhasil update kategori'
        );
    }

    public function destroy($id)
    {
        // Hapus data kategori berdasarkan ID
        DB::table('kategori')
            ->where('id', $id)
            ->delete();

        return back()->with(
            'success',
            'Berhasil hapus kategori'
        );
    }
}
