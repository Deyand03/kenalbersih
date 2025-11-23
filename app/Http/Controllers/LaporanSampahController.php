<?php

namespace App\Http\Controllers;

use App\Models\LaporanSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_warga()
    {
        $user = Auth::user();
        if($user->role == 'rt'){
            return redirect()->route('rt.laporan_sampah');
        }
        if (!$user->warga) {
            $laporans = LaporanSampah::where('id', -1)->paginate(5);

            session()->now('error', 'Akun Anda belum terhubung dengan data Warga. Silakan hubungi Admin.');

            return view('warga.laporan_sampah', compact('laporans'));
        }

        $laporans = LaporanSampah::where('warga_id', $user->warga->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('warga.laporan_sampah', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function index_rt()
    {
        $rtId = Auth::user()->rt->id;

        $laporans = LaporanSampah::with('warga')
            ->where('rt_id', $rtId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('rt_page.laporan_sampah', compact('laporans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diajukan,Diterima,Selesai'
        ]);

        $laporan = LaporanSampah::where('rt_id', Auth::user()->rt->id)->findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        return response()->json(['success' => true, 'message' => 'Status laporan berhasil diperbarui!']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Upload Foto
        $path = null;
        if ($request->hasFile('foto_bukti')) {
            $path = $request->file('foto_bukti')->store('bukti_laporan', 'cloudinary');
        }

        // Simpan ke Database
        LaporanSampah::create([
            'warga_id' => $user->warga->id,
            'rt_id' => $user->warga->rt_id,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'foto_bukti' => $path,
            'status' => 'Diajukan',
        ]);

        return redirect()->back()->with('success', 'Laporan Anda berhasil dikirim ke Ketua RT!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanSampah $laporanSampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanSampah $laporanSampah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanSampah $laporanSampah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanSampah $laporanSampah)
    {
        //
    }
}
