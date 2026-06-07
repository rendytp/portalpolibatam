<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('admin.layanan', compact(
            'data',
            'kategori'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama' => 'required',
            'url' => 'required'
        ]);

        DB::table('layanan')->insert([
            'id_kategori' => $request->id_kategori,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'url' => $request->url,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with(
            'success',
            'Berhasil tambah layanan'
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama' => 'required',
            'url' => 'required'
        ]);

        DB::table('layanan')
            ->where('id', $id)
            ->update([
                'id_kategori' => $request->id_kategori,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'url' => $request->url,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'updated_at' => now()
            ]);

        return back()->with(
            'success',
            'Berhasil update layanan'
        );
    }

    public function destroy($id)
    {
        DB::table('layanan')
            ->where('id', $id)
            ->delete();

        return back()->with(
            'success',
            'Berhasil hapus layanan'
        );
    }
}