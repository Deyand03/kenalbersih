<?php

namespace App\Http\Controllers;

use App\Models\JadwalAngkut;
use App\Models\Rt;
use App\Models\VolumeSampahBulan;
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

        $chartData = [
            'labels' => [],
            'organik' => [],
            'non_organik' => [],
            'b3' => []
        ];

        if ($rt) {
            $listTahun = VolumeSampahTahun::where('rt_id', $rt->id)
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');
            $selectedTahun = $request->input('tahun');
            if (!$selectedTahun && $listTahun->isNotEmpty()) {
                $selectedTahun = $listTahun->first();
            }
            $volumeTahun = VolumeSampahTahun::where('rt_id', $rt->id)
                ->where('tahun', $selectedTahun)
                ->first();
            if ($volumeTahun) {
                $allBulanData = $volumeTahun->volume_sampah_bulan()
                    ->orderBy('bulan', 'asc')
                    ->get();
                $chartData['labels'] = $allBulanData->map(function($item) {
                    return Carbon::createFromDate(null, $item->bulan, 1)->translatedFormat('F');
                })->toArray();

                $chartData['organik'] = $allBulanData->pluck('organik')->toArray();
                $chartData['non_organik'] = $allBulanData->pluck('non_organik')->toArray();
                $chartData['b3'] = $allBulanData->pluck('b3')->toArray();
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
                    'backgroundColor' => $event->status == 'Diangkut' ? '#10b981' : '#9ca3af',
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

    public function storeVolumeSampah(Request $request)
    {
        $rtId = Auth::user()->rt->id;

        $validated = $request->validate([
            'tahun' => 'required|integer|min:2020',
            'bulan' => 'required|integer|min:1|max:12',
            'organik' => 'required|numeric|min:0',
            'non_organik' => 'required|numeric|min:0',
            'b3' => 'required|numeric|min:0',
        ]);

        $volumeTahun = VolumeSampahTahun::firstOrCreate(
            ['rt_id' => $rtId, 'tahun' => $validated['tahun']],
            ['tahun' => $validated['tahun']] // Asumsi model VolumeSampahTahun punya field ini
        );

        VolumeSampahBulan::updateOrCreate(
            [
                'volume_tahun_id' => $volumeTahun->id,
                'bulan' => $validated['bulan']
            ],
            [
                'organik' => $validated['organik'],
                'non_organik' => $validated['non_organik'],
                'b3' => $validated['b3'],
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Data volume sampah berhasil disimpan!');
    }
}

