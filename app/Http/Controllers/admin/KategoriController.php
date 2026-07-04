<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // Sebelumnya: DB::table('kategori')->latest('id')->get();
        $data = Kategori::latest('id')->get();

        return view('admin.kategori', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        Kategori::create([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'Berhasil tambah kategori');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'Berhasil update kategori');
    }

    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();

        return back()->with('success', 'Berhasil hapus kategori');
    }
}