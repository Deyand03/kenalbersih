<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\VolumeSampahBulan;
use App\Models\VolumeSampahTahun;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request){
        $data_rt = Rt::with(['volume_sampah_tahun'])->get();
        $defaultRt = $data_rt->first();

        if(filled($request->no_rt) && filled($request->tahun)){
            $data_rt->volumeSampah = VolumeSampahBulan::whereHas('volume_sampah_tahun', function($query) use ($request){
                $query->where('rt_id', $request->no_rt)
                      ->where('tahun', $request->tahun);
            })->get();
        }

        return view('homepage', compact( 'defaultRt', 'data_rt' ));
    }
}
