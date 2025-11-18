<?php

namespace App\Http\Controllers;

use App\Models\JadwalAngkut;
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

        // Data untuk Chart (Default array kosong)
        $chartData = [
            'labels' => [],
            'organik' => [],
            'non_organik' => [],
            'b3' => []
        ];

        if ($rt) {
            // 1. Ambil List Tahun
            $listTahun = VolumeSampahTahun::where('rt_id', $rt->id)
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');

            // 2. Tentukan Tahun Terpilih
            $selectedTahun = $request->input('tahun');
            if (!$selectedTahun && $listTahun->isNotEmpty()) {
                $selectedTahun = $listTahun->first();
            }

            // 3. Cari Record Tahun tersebut
            $volumeTahun = VolumeSampahTahun::where('rt_id', $rt->id)
                ->where('tahun', $selectedTahun)
                ->first();

            if ($volumeTahun) {
                // --- LOGIKA CHART (LINE CHART) ---
                // Ambil semua bulan di tahun ini, urutkan dari Januari (1) ke Desember (12)
                $allBulanData = $volumeTahun->volume_sampah_bulan()
                    ->orderBy('bulan', 'asc')
                    ->get();

                // Mapping data untuk dikirim ke Chart JS
                $chartData['labels'] = $allBulanData->map(function($item) {
                    return Carbon::createFromDate(null, $item->bulan, 1)->translatedFormat('F');
                })->toArray();

                $chartData['organik'] = $allBulanData->pluck('organik')->toArray();
                $chartData['non_organik'] = $allBulanData->pluck('non_organik')->toArray();
                $chartData['b3'] = $allBulanData->pluck('b3')->toArray();

                // --- LOGIKA KARTU STATISTIK (BULANAN) ---
                $selectedBulan = $request->input('bulan');

                if (!$selectedBulan) {
                    $latestBulanRecord = $volumeTahun->volume_sampah_bulan()
                        ->orderBy('bulan', 'desc')
                        ->first();
                    $selectedBulan = $latestBulanRecord ? $latestBulanRecord->bulan : now()->month;
                }

                $dataBulan = $volumeTahun->volume_sampah_bulan()
                    ->where('bulan', $selectedBulan)
                    ->first();

                // Casting ke int untuk keamanan Carbon
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
            'selectedBulan',
            'chartData'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getEvents()
    {
        $rt = Auth::user()->rt;
        if (!$rt) return response()->json([]);

        $events = JadwalAngkut::where('rt_id', $rt->id)
            ->get(['id', 'jadwal', 'status'])
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->status == 'Diangkut' ? 'Diangkut' : 'Belum Diangkut',
                    'start' => $event->jadwal,
                    'backgroundColor' => $event->status == 'Diangkut' ? '#10b981' : '#9ca3af', // Hijau vs Abu
                    'borderColor' => $event->status == 'Diangkut' ? '#10b981' : '#9ca3af',
                    'extendedProps' => [
                        'status' => $event->status
                    ]
                ];
            });

        return response()->json($events);
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'jadwal' => 'required|date',
            'status' => 'required|in:Diangkut,Belum Diangkut'
        ]);

        $event = JadwalAngkut::create([
            'rt_id' => Auth::user()->rt->id,
            'jadwal' => $request->jadwal,
            'status' => $request->status
        ]);

        return response()->json(['success' => true, 'data' => $event]);
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'jadwal' => 'nullable|date',
            'status' => 'nullable|in:Diangkut,Belum Diangkut'
        ]);

        $event = JadwalAngkut::where('rt_id', Auth::user()->rt->id)->findOrFail($id);

        if ($request->has('jadwal')) $event->jadwal = $request->jadwal;
        if ($request->has('status')) $event->status = $request->status;

        $event->save();

        return response()->json(['success' => true]);
    }

    public function deleteEvent($id)
    {
        $event = JadwalAngkut::where('rt_id', Auth::user()->rt->id)->findOrFail($id);
        $event->delete();

        return response()->json(['success' => true]);
    }
}
