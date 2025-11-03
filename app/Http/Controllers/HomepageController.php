<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\VolumeSampahBulan;
use App\Models\VolumeSampahTahun;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $all_rts = Rt::orderBy('no_rt')->get();
        $selectedRtId = $request->input('no_rt', $all_rts->first()->id ?? null);
        $selectedTahun = $request->input('tahun', now()->year);

        $dataBulanan = collect();

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
        ]);
    }
}
