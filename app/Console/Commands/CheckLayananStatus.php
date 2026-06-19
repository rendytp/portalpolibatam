<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckLayananStatus extends Command
{
    // Nama perintah untuk memanggil robot ini
    protected $signature = 'layanan:check-status';

    // Deskripsi perintah
    protected $description = 'Mengecek apakah URL Layanan sedang aktif atau mengalami gangguan secara otomatis';

    public function handle()
    {
        $this->info('Mulai mengecek status layanan...');

        // Ambil semua data layanan dari database
        $layanans = DB::table('layanan')->get();

        foreach ($layanans as $layanan) {
            // Lewati jika URL kosong
            if (empty($layanan->url)) {
                continue; 
            }

            // Pastikan URL ada http/https nya
            $url = str_starts_with($layanan->url, 'http') ? $layanan->url : 'https://' . $layanan->url;

            try {
                // Robot mencoba mengunjungi URL tersebut (diberi batas waktu 5 detik agar tidak nyangkut)
                $response = Http::timeout(5)->get($url);

                // Jika statusnya 200-an (Sukses), berarti Aktif (1)
                // Jika error (404, 500), berarti Gangguan (0)
                $isActive = $response->successful() ? 1 : 0;

            } catch (\Exception $e) {
                // Jika website mati total / tidak bisa dijangkau sama sekali, berarti Gangguan (0)
                $isActive = 0;
            }

            // Update status terbaru ke database
            DB::table('layanan')->where('id', $layanan->id)->update([
                'is_active' => $isActive,
                'updated_at' => now(),
            ]);

            $statusText = $isActive ? 'Aktif' : 'Gangguan';
            $this->info("✔ {$layanan->nama} -> {$statusText}");
        }

        $this->info('Selesai mengupdate semua status layanan!');
    }
}