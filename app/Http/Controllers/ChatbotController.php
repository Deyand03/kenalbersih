<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\JadwalAngkut;
use App\Models\LaporanKeuangan;
use App\Models\LaporanSampah;
use App\Models\Rt;
use App\Models\VolumeSampahBulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $user = Auth::user();

        $links = [
            'home' => '<a href="' . route('homepage') . '" class="text-blue-600 underline font-bold hover:text-blue-800" >Halaman Utama</a>',
            'about' => '<a href="' . route('about') . '" class="text-blue-600 underline font-bold hover:text-blue-800" >Tentang Kami</a>',
            'transparansi_guest' => '<a href="' . route('pengeluaran') . '" class="text-blue-600 underline font-bold hover:text-blue-800" >Laporan Transparansi</a>',
            'login' => '<a href="' . route('login') . '" class="text-blue-600 underline font-bold hover:text-blue-800" >Login Disini</a>',
            'register' => '<a href="' . route('register.warga') . '" class="text-blue-600 underline font-bold hover:text-blue-800" >Daftar Akun</a>',
        ];

        // Link khusus yang telah login
        $memberLinks = [];
        if ($user && $user->role === 'warga' && $user->warga && $user->warga->status === 'Aktif') {
            $memberLinks = [
                'lapor_sampah' => '<a href="' . route('laporan_sampah') . '" class="text-blue-600 underline font-bold hover:text-blue-800">Form Lapor Sampah</a>',
                'bayar_iuran' => '<a href="' . route('iuran') . '" class="text-blue-600 underline font-bold hover:text-blue-800">Bayar Iuran</a>',
                'profil' => '<a href="' . route('profile') . '" class="text-blue-600 underline font-bold hover:text-blue-800">Profil Saya</a>',
            ];
        }

        // --- 2. BASE KNOWLEDGE (Identitas Bot) ---
        $baseContext = "Kamu adalah 'KenalBot', asisten virtual pintar untuk aplikasi 'KenalBersih'.\n" .
            "Fungsi Aplikasi: Sistem Pengelolaan Sampah & Iuran Warga tingkat RT.\n" .
            "Gaya Bicara: Ramah, Solutif, Informatif, menggunakan Bahasa Indonesia yang baik dan santai.\n" .
            "Tugas Utama: Membantu warga mengecek jadwal sampah, status iuran, dan transparansi dana.\n" .
            "PENTING: Jika user bertanya lokasi fitur atau cara melakukan sesuatu (misal: 'dimana bayar iuran?'), JANGAN HANYA JELASKAN, TAPI BERIKAN LINK HTML yang sesuai dari daftar link yang tersedia. Gunakan format HTML anchor tag persis seperti yang diberikan di daftar link.\n" .
            "Jangan berhalusinasi data. Jika data tidak ada di konteks, katakan tidak tahu atau sarankan hubungi Ketua RT.";

        $specificContext = "";

        // --- 3. SKENARIO USER LOGIN (WARGA) ---
        if ($user && $user->role === 'warga' && $user->warga) {
            $warga = $user->warga;
            $rt = $warga->rt;
            $statusWarga = $warga->status;

            // Cek Status Akun
            if ($statusWarga !== 'Aktif') {
                $specificContext = "INFO PENGGUNA:\n" .
                    "- Nama: {$warga->nama}\n" .
                    "- Status Akun: {$statusWarga} (User ini TIDAK BISA akses fitur lapor/bayar).\n" .
                    "- Pesan untuk user: Jelaskan bahwa akun mereka sedang dalam status '{$statusWarga}' dan perlu menghubungi RT untuk aktivasi agar bisa lapor sampah atau bayar iuran.";
            } else {
                // A. Data Real-time
                $today = now()->format('Y-m-d');
                $tomorrow = now()->addDay()->format('Y-m-d');

                $jadwalToday = JadwalAngkut::where('rt_id', $rt->id)->whereDate('jadwal', $today)->exists();
                $jadwalTomorrow = JadwalAngkut::where('rt_id', $rt->id)->whereDate('jadwal', $tomorrow)->exists();

                // B. Status Iuran Terakhir
                $lastIuran = Iuran::where('warga_id', $warga->id)->latest()->first();
                $statusIuran = $lastIuran
                    ? "Terakhir bayar: Rp " . number_format($lastIuran->jumlah_pembayaran) . " (" . $lastIuran->status_pembayaran . ") pada " . $lastIuran->created_at->format('d M Y')
                    : "Belum pernah tercatat membayar iuran.";

                // C. Saldo RT
                $totalMasuk = Iuran::where('rt_id', $rt->id)->where('status_pembayaran', 'Diterima')->sum('jumlah_pembayaran');
                $totalKeluar = LaporanKeuangan::where('rt_id', $rt->id)->sum('jumlah');
                $saldoRT = $totalMasuk - $totalKeluar;

                // D. Data sampah berdasarkan RT saat ini
                $volumeBulanIni = VolumeSampahBulan::whereHas('volume_sampah_tahun', function ($q) use ($rt) {
                    $q->where('rt_id', $rt->id)->where('tahun', now()->year);
                })->where('bulan', now()->month)->first();

                $sampahInfo = "Data Sampah RT {$rt->no_rt} Bulan Ini (" . now()->translatedFormat('F Y') . "):\n";
                if ($volumeBulanIni) {
                    $sampahInfo .= "- Organik: {$volumeBulanIni->organik} kg\n" .
                        "- Non-Organik: {$volumeBulanIni->non_organik} kg\n" .
                        "- B3: {$volumeBulanIni->b3} kg\n" .
                        "- Total: " . ($volumeBulanIni->organik + $volumeBulanIni->non_organik + $volumeBulanIni->b3) . " kg";
                } else {
                    $sampahInfo .= "Belum ada data volume sampah tercatat bulan ini.";
                }

                $specificContext = "INFO PENGGUNA (MEMBER):\n" .
                    "- Nama: {$warga->nama} (Warga RT {$rt->no_rt})\n" .
                    "- Status: Aktif\n\n" .
                    "DATA RT {$rt->no_rt}:\n" .
                    "- Jadwal Sampah Hari Ini: " . ($jadwalToday ? "ADA (Siapkan sampah!)" : "TIDAK ADA") . "\n" .
                    "- Jadwal Sampah Besok: " . ($jadwalTomorrow ? "ADA" : "TIDAK ADA") . "\n" .
                    "- Iuran Wajib: Rp " . number_format($rt->biaya_iuran) . " (" . $rt->jenis_iuran . ")\n" .
                    "- Kontak Ketua RT ({$rt->nama}): {$rt->no_hp}\n" .
                    "- Saldo Kas RT: Rp " . number_format($saldoRT) . "\n\n" .
                    "DATA PRIBADI USER:\n" .
                    "- Status Iuran Terakhir: {$statusIuran}\n\n" .
                    "DAFTAR LINK (Berikan HTML tag ini jika ditanya):\n" .
                    "- Link Lapor Sampah: " . $memberLinks['lapor_sampah'] . "\n" .
                    "- Link Bayar Iuran: " . $memberLinks['bayar_iuran'] . "\n" .
                    "- Link Profil Saya: " . $memberLinks['profil'] . "\n" .
                    "- Link Transparansi: " . $links['transparansi_guest'];
            }
        }

        // --- 4. SKENARIO GUEST (BELUM LOGIN) ---
        else {
            $totalOrganik = VolumeSampahBulan::sum('organik');
            $totalNonOrganik = VolumeSampahBulan::sum('non_organik');
            $totalB3 = VolumeSampahBulan::sum('b3');
            $totalSampah = $totalOrganik + $totalNonOrganik + $totalB3;

            // Ambil Info Umum RT (Misal Total Saldo Seluruh Desa buat pamer transparansi)
            $totalDanaDesa = Iuran::where('status_pembayaran', 'Diterima')->sum('jumlah_pembayaran') - LaporanKeuangan::sum('jumlah');

            $specificContext = "INFO PENGGUNA: Tamu (Guest / Belum Login).\n\n" .
                "DATA UMUM KENALBERSIH:\n" .
                "- Total Dana Transparansi Desa: Rp " . number_format($totalDanaDesa) . "\n\n" .
                "- Total Sampah Dikelola (Sejak Awal): {$totalSampah} kg (Organik: {$totalOrganik}, Non: {$totalNonOrganik}, B3: {$totalB3})\n\n" .
                "INSTRUKSI KHUSUS:\n" .
                "- Jika user tanya 'cara bayar iuran' atau 'lapor sampah', jawab sopan: 'Fitur itu khusus warga terdaftar. Silakan Login atau Daftar dulu ya!' dan berikan link Login/Register.\n" .
                "- Jika user tanya 'transparansi keuangan', berikan link Transparansi.\n" .
                "- Jika user tanya 'jadwal sampah', jelaskan fitur jadwal ada di dashboard warga.\n\n" .
                "DAFTAR LINK (Berikan HTML tag ini jika ditanya):\n" .
                "- Link Login: " . $links['login'] . "\n" .
                "- Link Daftar: " . $links['register'] . "\n" .
                "- Link Transparansi: " . $links['transparansi_guest'] . "\n" .
                "- Link Tentang Kami: " . $links['about'];
        }

        // --- 5. RAKIT PROMPT & KIRIM ---
        // Tambahkan instruksi spesifik agar AI tidak meng-escape HTML
        $finalPrompt = $baseContext . "\n\n" . $specificContext . "\n\n" .
            "INSTRUKSI FORMATTING: Jika kamu memberikan link, JANGAN ubah format HTML tag <a> yang saya berikan. Tampilkan apa adanya agar bisa diklik oleh user." .
            "\n\nUser: " . $userMessage . "\nAssistant:";

        $apiKey = env('GEMINI_API_KEY');
        // Gunakan model pro yang stabil
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key={$apiKey}";

        try {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post($url, [
                    'contents' => [['parts' => [['text' => $finalPrompt]]]]
                ]);

            if ($response->failed()) {
                Log::error('Gemini API Error: ' . $response->body());
                return response()->json(['reply' => 'Maaf, KenalBot lagi gangguan sinyal nih. Coba lagi nanti ya!']);
            }

            $responseData = $response->json();
            $reply = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya kurang paham.';

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            Log::error('Chatbot System Error: ' . $e->getMessage());
            return response()->json(['reply' => 'Sistem sedang error.'], 500);
        }
    }
}
