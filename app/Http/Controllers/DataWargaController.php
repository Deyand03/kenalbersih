<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataWargaController extends Controller
{
    public function index(Request $request){
        $rt_id = Auth::user()->rt->id;

        $query = Warga::where('rt_id', $rt_id)->with('user'); // Eager load user untuk ambil email

        // Fitur Pencarian Sederhana
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $wargas = $query->orderBy('nama', 'asc')->paginate(10);

        // Statistik Ringkas
        $totalWarga = Warga::where('rt_id', $rt_id)->count();
        $wargaAktif = Warga::where('rt_id', $rt_id)->where('status', 'Aktif')->count();

        return view('rt_page.data_warga', compact('wargas', 'totalWarga', 'wargaAktif'));
    }
    public function toggleStatus($id)
    {
        $rt_id = Auth::user()->rt->id;
        $warga = Warga::where('id', $id)->where('rt_id', $rt_id)->firstOrFail();

        // Switch Status
        $newStatus = $warga->status == 'Aktif' ? 'Non-aktif' : 'Aktif';
        $warga->update(['status' => $newStatus]);


        $message = $newStatus == 'Aktif'
            ? "Warga kembali diaktifkan."
            : "Warga berhasil dinonaktifkan.";

        return redirect()->back()->with('success', $message);
    }
}
