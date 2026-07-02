<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\LayananController;

class CekStatusLayanan extends Command
{
    protected $signature   = 'layanan:cek-status';
    protected $description = 'Cek status semua URL layanan secara otomatis (dijadwalkan tiap 24 jam)';

    public function handle()
    {
        $this->info('Mulai pengecekan status layanan...');

        $layanan = DB::table('layanan')
            ->whereNotNull('url')
            ->where('url', '!=', '')
            ->get();

        if ($layanan->isEmpty()) {
            $this->warn('Tidak ada layanan yang perlu dicek.');
            return;
        }

        $controller = new LayananController();
        $updated    = 0;

        foreach ($layanan as $item) {
            $statusBaru = $controller->checkUrlStatus($item->url);

            // Hanya update jika status berubah (hemat query)
            if ($item->is_active != $statusBaru) {
                DB::table('layanan')
                    ->where('id', $item->id)
                    ->update([
                        'is_active'  => $statusBaru,
                        'updated_at' => now(),
                    ]);

                $label = match ($statusBaru) {
                    1 => 'Aktif',
                    2 => 'Sedang Gangguan',
                    default => 'Nonaktif',
                };

                $this->line("[UPDATE] {$item->nama} → {$label}");
                $updated++;
            } else {
                $this->line("[OK]     {$item->nama} → status tidak berubah");
            }
        }

        $total = $layanan->count();
        $this->info("Selesai. {$updated} dari {$total} layanan diperbarui.");
    }
}