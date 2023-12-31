<?php

namespace App\Console\Commands;

use App\Models\Jadwal;
use Illuminate\Console\Command;

class CheckJadwal extends Command
{
    protected $signature = 'check:jadwal';

    protected $description = 'Check jadwal and perform actions';

    public function handle()
    {
        $this->info('Checking jadwal...');

        $expiredJadwals = Jadwal::where('end_date', '<', now())->where('status', 'available')->get();

        foreach ($expiredJadwals as $jadwal) {
            $jadwal->update(['status' => 'expired']);
        }

        $this->info('Jadwal checked successfully.');
    }
}
