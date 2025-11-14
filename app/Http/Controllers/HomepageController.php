<?php

namespace App\Http\Controllers;

use App\Models\JadwalAngkut;
use App\Models\Rt;
use App\Models\VolumeSampahBulan;
use App\Models\VolumeSampahTahun;
use App\Models\Warga;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $all_rts = Rt::all();
        $jumlah_warga = Warga::count();

        $selectedRtId = $request->input('rt_id', $all_rts->first()->id ?? null);
        $selectedTahun = $request->input('tahun', now()->year);

        $totalOrganik = VolumeSampahBulan::sum('organik');
        $totalNonOrganik = VolumeSampahBulan::sum('non_organik');
        $totalB3 = VolumeSampahBulan::sum('b3');
        $totalSampahTerkelola = $totalOrganik + $totalNonOrganik + $totalB3;

        $list_tahun = collect();
        $dataBulanan = collect();
        if ($selectedRtId) {
            $list_tahun = VolumeSampahTahun::where('rt_id', $selectedRtId)
                ->select('tahun')
                ->distinct()
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');
        }
        if (!$list_tahun->contains($selectedTahun)) {
            $selectedTahun = $list_tahun->first() ?? now()->year;
        }
        if ($selectedRtId) {
            $rt = Rt::find($selectedRtId);
            $dataBulanan = $rt->volume_sampah_bulan()
                ->whereHas('volume_sampah_tahun', function ($query) use ($selectedTahun) {
                    $query->where('tahun', $selectedTahun);
                })
                ->orderBy('bulan')
                ->get();
        }


        return view('homepage', [
            'all_rts' => $all_rts,
            'selectedRtId' => $selectedRtId,
            'selectedTahun' => $selectedTahun,
            'dataBulanan' => $dataBulanan,
            'list_tahun' => $list_tahun,
            'jumlah_warga' => $jumlah_warga,
            'totalSampahTerkelola' => $totalSampahTerkelola
        ]);
    }

    public function data_jadwal(Request $request)
    {
        $all_rts = Rt::all();
        $selectedRtId = $request->input('rt_id', $all_rts->first()->id ?? null);
        $events = JadwalAngkut::where('rt_id', $selectedRtId)->get(['id', 'jadwal', 'status', 'rt_id']);
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
    //     $all_rts = Rt::orderBy('no_rt')->get();
    //     $selectedRtId = $request->input('no_rt', $all_rts->first()->id ?? null);
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
