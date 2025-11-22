<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\LaporanKeuangan;
use App\Models\Rt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function index_warga(Request $request)
    {
        $list_rt = Rt::all();

        $tahun_iuran = Iuran::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year');
        $tahun_pengeluaran = LaporanKeuangan::selectRaw('YEAR(tanggal) as year')->distinct()->pluck('year');

        // Gabung dan urutkan descending (terbaru di atas)
        $available_years = $tahun_iuran->merge($tahun_pengeluaran)->unique()->sortDesc()->values();

        // Kalau kosong (belum ada data), kasih default tahun sekarang
        if ($available_years->isEmpty()) {
            $available_years = [date('Y')];
        }

        $queryPemasukan = Iuran::where('status_pembayaran', 'Diterima');
        $queryPengeluaran = LaporanKeuangan::query();

        // --- LOGIC FILTER RT ---
        // Kalau user milih RT tertentu, filter datanya.
        // Kalau nggak milih, berarti hitung total SEMUA RT (Desa).
        $rtName = 'Semua Lingkungan RT';
        $rtDesc = 'Laporan gabungan seluruh RT'; // Default description
        if ($request->filled('rt_id')) {
            $queryPemasukan->where('rt_id', $request->rt_id);
            $queryPengeluaran->where('rt_id', $request->rt_id);

            $rtSelected = Rt::find($request->rt_id);
            if ($rtSelected) {
                $rtName = "RT " . $rtSelected->no_rt . " - " . $rtSelected->nama;
                $rtDesc = $rtSelected->alamat_rumah ?? 'Lingkungan RT ' . $rtSelected->no_rt;
            }
        }

        // 3. Hitung Saldo (Lifetime / Akumulasi Selamanya)
        // Saldo itu biasanya akumulasi dari awal berdiri sampai sekarang,
        // jadi kita JANGAN filter bulan/tahun untuk saldo, kecuali diminta spesifik.
        // Kita pakai clone biar query aslinya gak berubah.
        $totalMasuk = (clone $queryPemasukan)->sum('jumlah_pembayaran');
        $totalKeluar = (clone $queryPengeluaran)->sum('jumlah');
        $saldoAkhir = $totalMasuk - $totalKeluar;

        // 4. Data Tabel Pengeluaran (Bisa difilter Bulan & Tahun)
        $tabelPengeluaran = clone $queryPengeluaran;

        if ($request->filled('bulan')) {
            $tabelPengeluaran->whereMonth('tanggal', $request->bulan);
        }
        $selectedYear = $request->get('tahun', date('Y'));
        $tabelPengeluaran->whereYear('tanggal', $selectedYear);

        $riwayat = $tabelPengeluaran->with('rt')
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Ambil datanya buat tabel
        $riwayat = $tabelPengeluaran->with('rt') // Eager load RT biar tau ini pengeluaran RT mana
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString(); // Biar pas ganti halaman, filternya gak ilang

        // 5. Data Grafik (6 Bulan Terakhir)
        // Ini logic-nya sama kayak yang RT Page, tapi kita sesuaikan biar kena filter RT juga
        $labels = [];
        $dataPemasukan = [];
        $dataPengeluaran = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $month = $date->month;
            $year = $date->year;

            $labels[] = $date->translatedFormat('F');

            // Query ulang untuk bulan spesifik ini, tapi tetep bawa filter RT di atas
            $inc = (clone $queryPemasukan)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('jumlah_pembayaran');

            $exp = (clone $queryPengeluaran)
                ->whereMonth('tanggal', $month)
                ->whereYear('tanggal', $year)
                ->sum('jumlah');

            $dataPemasukan[] = $inc;
            $dataPengeluaran[] = $exp;
        }

        $chartData = [
            'labels' => $labels,
            'pemasukan' => $dataPemasukan,
            'pengeluaran' => $dataPengeluaran
        ];

        return view('warga.laporan_pengeluaran', compact(
            'list_rt',
            'available_years',
            'selectedYear',
            'rtName',
            'rtDesc',
            'saldoAkhir',
            'totalMasuk',
            'totalKeluar',
            'riwayat',
            'chartData'
        ));
    }
    public function index_rt()
    {
        $rtId = Auth::user()->rt->id;

        // 1. Hitung Saldo (Total Pemasukan - Total Pengeluaran)
        $totalPemasukan = Iuran::where('rt_id', $rtId)
            ->where('status_pembayaran', 'Diterima')
            ->sum('jumlah_pembayaran');

        $totalPengeluaran = LaporanKeuangan::where('rt_id', $rtId)->sum('jumlah');

        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // 2. Statistik Bulan Ini
        $pengeluaranBulanIni = LaporanKeuangan::where('rt_id', $rtId)
            ->whereMonth('tanggal', now()->month)
            ->sum('jumlah');

        // 3. Data Tabel (Riwayat)
        $pengeluarans = LaporanKeuangan::where('rt_id', $rtId)
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        // 4. Data Grafik (6 Bulan Terakhir) - Pemasukan vs Pengeluaran
        $labels = [];
        $dataPemasukan = [];
        $dataPengeluaran = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $month = $date->month;
            $year = $date->year;

            $labels[] = $date->translatedFormat('F');

            $dataPemasukan[] = Iuran::where('rt_id', $rtId)
                ->where('status_pembayaran', 'Diterima')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('jumlah_pembayaran');

            $dataPengeluaran[] = LaporanKeuangan::where('rt_id', $rtId)
                ->whereMonth('tanggal', $month)
                ->whereYear('tanggal', $year)
                ->sum('jumlah');
        }

        $chartData = [
            'labels' => $labels,
            'pemasukan' => $dataPemasukan,
            'pengeluaran' => $dataPengeluaran
        ];

        return view('rt_page.laporan_pengeluaran', compact(
            'saldoAkhir',
            'pengeluaranBulanIni',
            'pengeluarans',
            'chartData'
        ));
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'bukti_foto' => 'nullable|image|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('bukti_foto')) {
            $path = $request->file('bukti_foto')->store('bukti_pengeluaran', 'public');
        }

        LaporanKeuangan::create([
            'rt_id' => Auth::user()->rt->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'bukti_foto' => $path,
        ]);

        return redirect()->back()->with('success', 'Pengeluaran berhasil dicatat!');
    }
}
