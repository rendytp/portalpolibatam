<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Daftarkan semua Artisan command di sini
     */
    protected $commands = [
        \App\Console\Commands\CekStatusLayanan::class,
    ];

    /**
     * Jadwalkan command yang berjalan otomatis
     */
    protected function schedule(Schedule $schedule): void
    {
        // Cek status semua layanan setiap 24 jam (jam 01:00 dini hari)
        $schedule->command('layanan:cek-status')
            ->dailyAt('01:00')
            ->appendOutputTo(storage_path('logs/cek-status-layanan.log'));
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
