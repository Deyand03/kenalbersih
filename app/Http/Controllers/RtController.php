<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\VolumeSampahTahun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rt = Auth::user()->rt;

        // Default Values
        $organik = 0;
        $nonOrganik = 0;
        $b3 = 0;
        $bulanInfo = 'Data tidak tersedia';

        $listTahun = collect();
        $selectedTahun = null;
        $selectedBulan = null;

        if ($rt) {
            // 1. Ambil List Tahun untuk Dropdown Filter
            $listTahun = VolumeSampahTahun::where('rt_id', $rt->id)
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');

            // 2. Tentukan Tahun Terpilih (Input User atau Default Tahun Terbaru)
            $selectedTahun = $request->input('tahun');
            if (!$selectedTahun && $listTahun->isNotEmpty()) {
                $selectedTahun = $listTahun->first();
            }

            // 3. Cari Record Tahun tersebut
            $volumeTahun = VolumeSampahTahun::where('rt_id', $rt->id)
                ->where('tahun', $selectedTahun)
                ->first();

            if ($volumeTahun) {
                // 4. Tentukan Bulan Terpilih (Input User atau Default Bulan Terakhir di tahun tsb)
                $selectedBulan = $request->input('bulan');

                if (!$selectedBulan) {
                    // Kalau user gak milih bulan, cari bulan paling akhir yg datanya ada
                    $latestBulanRecord = $volumeTahun->volume_sampah_bulan()
                        ->orderBy('bulan', 'desc')
                        ->first();
                    $selectedBulan = $latestBulanRecord ? $latestBulanRecord->bulan : now()->month;
                }

                // 5. Ambil Data Sampah berdasarkan Tahun & Bulan terpilih
                $dataBulan = $volumeTahun->volume_sampah_bulan()
                    ->where('bulan', $selectedBulan)
                    ->first();

                // Nama Bulan untuk Info (Contoh: "Januari 2025")
                // Lyra's Fix:
                // 1. Casting (int) $selectedBulan karena request input itu string.
                // 2. Pakai createFromDate(null, bulan, 1) untuk set tanggal ke 1, mencegah error overflow di tanggal 31.
                $namaBulan = Carbon::createFromDate(null, (int) $selectedBulan, 1)->translatedFormat('F');
                $bulanInfo = "$namaBulan $selectedTahun";

                if ($dataBulan) {
                    $organik = $dataBulan->organik;
                    $nonOrganik = $dataBulan->non_organik;
                    $b3 = $dataBulan->b3;
                } else {
                    $bulanInfo .= ' (Kosong)';
                }
            }
        }

        return view('rt_page.dashboard', compact(
            'organik',
            'nonOrganik',
            'b3',
            'bulanInfo',
            'listTahun',
            'selectedTahun',
            'selectedBulan'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rt $rt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rt $rt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rt $rt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rt $rt)
    {
        //
    }
}
