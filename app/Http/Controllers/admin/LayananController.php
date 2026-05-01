<?php

namespace App\Http\Controllers\Admin;

use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LayananController extends Controller
{
    public function index()
    {
        $data = Layanan::latest()->get();
        return view('admin.layanan', compact('data'));
    }

    public function store(Request $request)
    {
        Layanan::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'icon' => $request->icon
        ]);

        return back()->with('success', 'Berhasil tambah layanan');
    }

    public function update(Request $request, $id)
    {
        $item = Layanan::findOrFail($id);

        $item->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'icon' => $request->icon
        ]);

        return back()->with('success', 'Berhasil update');
    }

    public function destroy($id)
    {
        Layanan::destroy($id);
        return back()->with('success', 'Berhasil hapus');
    }
}
