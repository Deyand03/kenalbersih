<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\JadwalAngkut;
use App\Models\LaporanKeuangan;
use App\Models\LaporanSampah;
use App\Models\Rt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $user = Auth::user(); // Cek user yang login

        // --- KONTEKS UMUM ---
        $baseContext = "Kamu adalah 'KenalBot', asisten virtual pintar untuk aplikasi 'KenalBersih' (Sistem Pengelolaan Sampah & Iuran RT). \n" .
            "Gaya bicaramu: Ramah, santai, sangat membantu, dan menggunakan Bahasa Indonesia yang natural. \n" .
            "Jangan pernah mengarang data fakta. Jika data tidak tersedia di konteks, bilang saja kamu tidak tahu atau sarankan hubungi RT.";

        $specificContext = "";

        // --- SKENARIO 1: USER LOGIN (WARGA) ---
        if ($user && $user->role === 'warga' && $user->warga) {
            $warga = $user->warga;
            $rt = $warga->rt;

            // A. Data Jadwal (Hari ini & Besok)
            $today = now()->format('Y-m-d');
            $tomorrow = now()->addDay()->format('Y-m-d');

            $jadwalToday = JadwalAngkut::where('rt_id', $rt->id)->whereDate('jadwal', $today)->exists();
            $jadwalTomorrow = JadwalAngkut::where('rt_id', $rt->id)->whereDate('jadwal', $tomorrow)->exists();

            $jadwalInfo = "Jadwal Angkut Sampah RT {$rt->no_rt}:\n" .
                "- Hari Ini: " . ($jadwalToday ? "ADA (Siapkan sampahmu!)" : "Tidak ada.") . "\n" .
                "- Besok: " . ($jadwalTomorrow ? "ADA." : "Tidak ada.") . "\n";

            // B. Data Iuran (Status Terakhir)
            $lastIuran = Iuran::where('warga_id', $warga->id)->latest()->first();
            $statusIuran = $lastIuran
                ? "Terakhir bayar: Rp " . number_format($lastIuran->jumlah_pembayaran) . " (" . $lastIuran->status_pembayaran . ") pada " . $lastIuran->created_at->format('d M Y')
                : "Belum pernah membayar iuran.";

            $tarifInfo = "Tarif Iuran RT {$rt->no_rt}: Rp " . number_format($rt->biaya_iuran) . "/" . $rt->jenis_iuran;

            // C. Data Laporan Sampah (Status Terakhir)
            $lastLaporan = LaporanSampah::where('warga_id', $warga->id)->latest()->first();
            $laporanInfo = $lastLaporan
                ? "Laporan sampah terakhirmu statusnya: '{$lastLaporan->status}' (" . $lastLaporan->created_at->diffForHumans() . ")"
                : "Belum ada laporan sampah aktif.";

            // D. Transparansi (Saldo RT)
            // Hitung kasar saldo (Pemasukan - Pengeluaran)
            $totalMasuk = Iuran::where('rt_id', $rt->id)->where('status_pembayaran', 'Diterima')->sum('jumlah_pembayaran');
            $totalKeluar = LaporanKeuangan::where('rt_id', $rt->id)->sum('jumlah');
            $saldoRT = $totalMasuk - $totalKeluar;
            $saldoInfo = "Saldo Kas RT {$rt->no_rt} saat ini: Rp " . number_format($saldoRT);

            // RAKIT KONTEKS KHUSUS WARGA
            $specificContext = "INFO PENGGUNA:\n" .
                "- Nama: {$warga->nama} (Warga RT {$rt->no_rt})\n" .
                "- Status Akun: {$warga->status}\n\n" .
                "DATA REAL-TIME (Gunakan ini untuk menjawab):\n" .
                "1. {$jadwalInfo}\n" .
                "2. {$tarifInfo}\n" .
                "3. Status Iuran User: {$statusIuran}\n" .
                "4. Status Laporan User: {$laporanInfo}\n" .
                "5. {$saldoInfo}\n" .
                "6. Kontak Pak RT ({$rt->nama}): {$rt->no_hp}\n\n" .
                "INSTRUKSI KHUSUS: \n" .
                "- Jika user tanya 'kapan sampah diambil?', lihat data Jadwal Angkut.\n" .
                "- Jika user tanya 'apakah saya sudah bayar?', lihat data Status Iuran User.\n" .
                "- Jika user tanya 'uang kas dipakai buat apa?', jelaskan secara umum bahwa data ada di menu Transparansi, dan sebutkan Saldo saat ini.";
        }

        // --- SKENARIO 2: GUEST (BELUM LOGIN) ---
        else {
            $specificContext = "INFO PENGGUNA: Tamu (Belum Login).\n\n" .
                "INSTRUKSI KHUSUS:\n" .
                "- Jelaskan fitur KenalBersih secara umum (Jadwal Sampah, Bayar Iuran Digital, Laporan Warga, Transparansi Keuangan).\n" .
                "- Jika mereka bertanya data spesifik (misal: 'jadwal RT 5 kapan?'), minta mereka LOGIN terlebih dahulu untuk melihat data akurat.\n" .
                "- Bersikaplah ramah dan ajak mereka untuk mendaftar.";
        }

        // Gabungkan Prompt
        $finalPrompt = $baseContext . "\n\n" . $specificContext . "\n\n" . "User: " . $userMessage . "\nAssistant:";

        // Kirim ke Gemini
        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key={$apiKey}";

        try {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post($url, [
                    'contents' => [['parts' => [['text' => $finalPrompt]]]]
                ]);

            if ($response->failed()) {
                Log::error('Gemini API Error: ' . $response->body());
                return response()->json(['reply' => 'Maaf, KenalBot lagi pusing (API Error). Coba lagi nanti ya!']);
            }

            $responseData = $response->json();
            $reply = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak mengerti.';

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            Log::error('Chatbot System Error: ' . $e->getMessage());
            return response()->json(['reply' => 'Terjadi kesalahan sistem.'], 500);
        }
    }
}
