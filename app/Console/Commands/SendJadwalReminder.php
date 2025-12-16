<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JadwalAngkut;
use App\Models\Warga;
use App\Services\FonnteService;
use Carbon\Carbon;

class SendJadwalReminder extends Command
{
    // Nama perintah yang bakal dipanggil scheduler
    protected $signature = 'jadwal:send-reminder';

    // Deskripsi
    protected $description = 'Kirim notifikasi WA jadwal angkut sampah ke warga terkait';

    public function handle()
    {
        $today = Carbon::today();

        $jadwals = JadwalAngkut::whereDate('jadwal', $today)->get();

        if ($jadwals->isEmpty()) {
            $this->info('Tidak ada jadwal angkut hari ini.');
            return;
        }

        $this->info("Ditemukan " . $jadwals->count() . " jadwal hari ini. Memproses...");

        foreach ($jadwals as $jadwal) {
            // 2. Ambil RT terkait
            $rtId = $jadwal->rt_id;

            // 3. Ambil semua warga di RT tersebut yang statusnya Aktif
            // Kita ambil nomor HP-nya aja (pluck)
            $nomorWarga = Warga::where('rt_id', $rtId)
                ->where('status', 'Aktif')
                ->pluck('no_hp')
                ->toArray(); // Ubah jadi array biasa

            if (empty($nomorWarga)) {
                $this->info("RT {$rtId} tidak memiliki warga aktif.");
                continue;
            }

            // 4. Siapkan Pesan
            $tanggalIndo = $today->translatedFormat('l, d F Y');
            $pesan = "📢 *PENGUMUMAN RT*\n\n"
                . "Halo Warga RT {$jadwal->rt->no_rt}!\n"
                . "Mengingatkan bahwa hari ini, *$tanggalIndo*, adalah jadwal pengangkutan sampah.\n\n"
                . "Mohon siapkan tempat sampah Anda di depan rumah sebelum petugas datang.\n\n"
                . "Terima kasih atas kerjasamanya menjaga kebersihan lingkungan kita! 🌱\n"
                . "- Pengurus KenalBersih";

            $target = implode(',', $nomorWarga); // "0812...,0813...,0815..."

            $this->info("Mengirim ke warga RT {$rtId}...");
            $response = FonnteService::send($target, $pesan);

            if ($response && isset($response['status']) && $response['status']) {
                $this->info("Sukses kirim ke RT {$rtId}");
            } else {
                $this->error("Gagal kirim ke RT {$rtId}");
            }
        }

        $this->info('Selesai.');
    }
}
