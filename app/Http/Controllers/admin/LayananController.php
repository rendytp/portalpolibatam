<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class LayananController extends Controller
{
    public function index()
    {
        // Sebelumnya: DB::table('layanan')->leftJoin('kategori', ...)->select(...)
        // "kategoriRelation" di-eager-load agar $item->kategori (accessor di model)
        // tidak memicu query tambahan per baris (hindari N+1).
        $data = Layanan::with('kategoriRelation')
            ->latest('id')
            ->get();

        $kategori = Kategori::all();

        return view('admin.layanan', compact('data', 'kategori'));
    }

    public function checkUrlStatus($url)
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept'     => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            ])
                ->timeout(8)
                ->withoutVerifying()
                ->get($url);

            $status = $response->status();

            if ($status >= 200 && $status < 400) {
                return 1; // Aktif (200–399 termasuk redirect)
            } elseif ($status >= 500) {
                return 2; // Gangguan (server error 500+)
            } else {
                return 0; // Nonaktif (404, 403, dst)
            }
        } catch (ConnectionException $e) {
            $message = strtolower($e->getMessage());

            if (
                str_contains($message, 'timed out') ||
                str_contains($message, 'timeout') ||
                str_contains($message, 'operation timed')
            ) {
                return 2; // Server ada tapi lambat/tidak merespons = Gangguan
            }

            return 0; // Connection refused / host not found / DNS error = Nonaktif
        } catch (\Exception $e) {
            $message = strtolower($e->getMessage());

            if (
                str_contains($message, 'timed out') ||
                str_contains($message, 'timeout')
            ) {
                return 2; // Gangguan
            }

            return 0; // Semua error lain = Nonaktif
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id',
            'nama'        => 'required|string|max:255',
            'url'         => 'required|url',
            'deskripsi'   => 'nullable|string|max:500',
        ]);

        $statusOtomatis = $this->checkUrlStatus($request->url);

        Layanan::create([
            'id_kategori' => $request->id_kategori,
            'nama'        => $request->nama,
            'deskripsi'   => $request->deskripsi,
            'url'         => $request->url,
            'is_active'   => $statusOtomatis,
        ]);

        return back()->with('success', 'Layanan ditambahkan & Status dicek otomatis!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id',
            'nama'        => 'required|string|max:255',
            'url'         => 'required|url',
            'deskripsi'   => 'nullable|string|max:500',
        ]);

        $layanan = Layanan::findOrFail($id);

        $statusOtomatis = $this->checkUrlStatus($request->url);

        $layanan->update([
            'id_kategori' => $request->id_kategori,
            'nama'        => $request->nama,
            'deskripsi'   => $request->deskripsi,
            'url'         => $request->url,
            'is_active'   => $statusOtomatis,
        ]);

        return back()->with('success', 'Layanan diupdate & Status diperbarui otomatis!');
    }

    public function destroy($id)
    {
        Layanan::findOrFail($id)->delete();

        return back()->with('success', 'Berhasil hapus layanan');
    }
}