<?php

namespace App\Http\Controllers;

use App\Models\JadwalAngkut;
use App\Models\Rt;
use App\Models\VolumeSampahBulan;
use App\Models\VolumeSampahTahun;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $allRts = Rt::all();
        $jumlahWarga = Warga::count();

        $defaultRtId = $allRts->first()->id ?? null;

        // Cek: Apakah user login? Apakah role-nya RT? Apakah dia punya data RT?
        if (Auth::check() && Auth::user()->role === 'rt' && Auth::user()->rt) {
            $defaultRtId = Auth::user()->rt->id;
        }

        // Ambil dari input user, kalau kosong pakai default yang sudah kita tentukan di atas
        $selectedRtId = $request->input('rt_id', $defaultRtId);
        $selectedTahun = $request->input('tahun', now()->year);

        // --- Statistik Global (Tetap sama) ---
        $totalOrganik = VolumeSampahBulan::sum('organik');
        $totalNonOrganik = VolumeSampahBulan::sum('non_organik');
        $totalB3 = VolumeSampahBulan::sum('b3');
        $totalSampahTerkelola = $totalOrganik + $totalNonOrganik + $totalB3;

        $listTahun = collect();
        $dataBulanan = collect();

        if ($selectedRtId) {
            $rt = Rt::find($selectedRtId);

            // Pastikan $rt ketemu dulu baru panggil relasinya
            if ($rt) {
                $listTahun = VolumeSampahTahun::where('rt_id', $selectedRtId)
                    ->select('tahun')
                    ->distinct()
                    ->orderBy('tahun', 'desc')
                    ->pluck('tahun');

                if (!$listTahun->contains($selectedTahun)) {
                    $selectedTahun = $listTahun->first() ?? now()->year;
                }

                $dataBulanan = $rt->volume_sampah_bulan()
                    ->whereHas('volume_sampah_tahun', function ($query) use ($selectedTahun) {
                        $query->where('tahun', $selectedTahun);
                    })
                    ->orderBy('bulan')
                    ->get();
            }
        }

        return view('homepage', [
            'allRts' => $allRts,
            'selectedRtId' => $selectedRtId,
            'selectedTahun' => $selectedTahun,
            'dataBulanan' => $dataBulanan,
            'listTahun' => $listTahun,
            'jumlahWarga' => $jumlahWarga,
            'totalSampahTerkelola' => $totalSampahTerkelola
        ]);
    }

    public function data_jadwal(Request $request)
    {
        $allRts = Rt::all();

        // 1. Tentukan Default ID (Sama seperti di index)
        $defaultRtId = $allRts->first()->id ?? null;
        if (Auth::check() && Auth::user()->role === 'rt' && Auth::user()->rt) {
            $defaultRtId = Auth::user()->rt->id;
        }

        $selectedRtId = $request->input('rt_id', $defaultRtId);

        $events = [];

        // 2. Validasi: Pastikan ID tidak null DAN RT-nya benar-benar ada di database
        if ($selectedRtId && Rt::where('id', $selectedRtId)->exists()) {
            $events = JadwalAngkut::where('rt_id', $selectedRtId)
                ->get(['id', 'jadwal', 'status', 'rt_id']);
        }

        return response()->json($events);
    }

    public function fetchTahun(Request $request)
    {
        $rtId = $request->input('rt_id');

        $tahuns = VolumeSampahTahun::where('rt_id', $rtId)
            ->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return response()->json($tahuns);
    }

    // public function data_grafik(Request $request)
    // {
    //     $allRts = Rt::orderBy('no_rt')->get();
    //     $selectedRtId = $request->input('no_rt', $allRts->first()->id ?? null);
    //     $selectedTahun = $request->input('tahun', now()->year);

    //     $dataBulanan = collect();

    //     if ($selectedRtId) {
    //         $rt = Rt::find($selectedRtId);
    //         $dataBulanan = $rt->volume_sampah_bulan()
    //             ->whereHas('volume_sampah_tahun', function ($query) use ($selectedTahun) {
    //                 $query->where('tahun', $selectedTahun);
    //             })
    //             ->orderBy('bulan')
    //             ->get();
    //     }

    //     return response()->json($dataBulanan);
    // }
}
