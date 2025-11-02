<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\VolumeSampahBulan;
use App\Models\VolumeSampahTahun;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request){
        $defaultRt = VolumeSampahTahun::with(['rt', 'volume_sampah_bulan'])->first();
        $rts = Rt::with(['volume_sampah_tahun'])->get();
        @dd($rts);
        return view('homepage', compact('rts', 'defaultRt'));
    }
}
