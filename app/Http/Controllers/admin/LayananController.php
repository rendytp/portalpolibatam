<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class LayananController extends Controller
{
    public function index()
    {
        $data = DB::table('layanan')
            ->leftJoin('kategori', 'layanan.id_kategori', '=', 'kategori.id')
            ->select('layanan.*', 'kategori.nama as kategori')
            ->latest('layanan.id')
            ->get();

        $kategori = DB::table('kategori')->get();

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
            // Bedakan timeout vs connection refused
            $message = strtolower($e->getMessage());

            if (
                str_contains($message, 'timed out') ||
                str_contains($message, 'timeout') ||
                str_contains($message, 'operation timed')
            ) {
                // Server ada tapi lambat/tidak merespons = Gangguan
                return 2;
            }

            // Connection refused / host not found / DNS error = web mati = Nonaktif
            return 0;
        } catch (\Exception $e) {
            $message = strtolower($e->getMessage());

            if (
                str_contains($message, 'timed out') ||
                str_contains($message, 'timeout')
            ) {
                return 2; // Gangguan
            }

            // Semua error lain (DNS gagal, connection refused, dsb) = Nonaktif
            return 0;
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama'        => 'required|string|max:255',
            'url'         => 'required|url',
            'deskripsi'   => 'nullable|string|max:500',
        ]);

        $statusOtomatis = $this->checkUrlStatus($request->url);

        DB::table('layanan')->insert([
            'id_kategori' => $request->id_kategori,
            'nama'        => $request->nama,
            'deskripsi'   => $request->deskripsi,
            'url'         => $request->url,
            'is_active'   => $statusOtomatis,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return back()->with('success', 'Layanan ditambahkan & Status dicek otomatis!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama'        => 'required|string|max:255',
            'url'         => 'required|url',
            'deskripsi'   => 'nullable|string|max:500',
        ]);

        $statusOtomatis = $this->checkUrlStatus($request->url);

        DB::table('layanan')
            ->where('id', $id)
            ->update([
                'id_kategori' => $request->id_kategori,
                'nama'        => $request->nama,
                'deskripsi'   => $request->deskripsi,
                'url'         => $request->url,
                'is_active'   => $statusOtomatis,
                'updated_at'  => now(),
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
