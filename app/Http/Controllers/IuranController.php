<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IuranController extends Controller
{
    public function index_warga(){
        $user = Auth::user();

        // 1. Security Check
        if ($user->role === 'rt') {
            return redirect()->route('rt.kelola.iuran');
        }
        if (!$user->warga) {
            return redirect()->route('homepage')->with('error', 'Profil Warga belum lengkap.');
        }

        $warga = $user->warga;
        $rt = $warga->rt; // Kita butuh info RT (No Dana, Biaya, Jenis Iuran)

        // 2. Ambil Riwayat Iuran Warga Ini
        $riwayats = Iuran::where('warga_id', $warga->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('warga.iuran', compact('warga', 'rt', 'riwayats'));
    }
    public function index_rt(){
        $rt = Auth::user()->rt;
        $rtId = $rt->id;

        // Statistik Sederhana
        $totalPemasukan = Iuran::where('rt_id', $rtId)
            ->where('status_pembayaran', 'Diterima')
            ->whereMonth('created_at', now()->month)
            ->sum('jumlah_pembayaran');

        $menungguKonfirmasi = Iuran::where('rt_id', $rtId)
            ->where('status_pembayaran', 'Menunggu')
            ->count();

        // Data Tab 1: Menunggu Konfirmasi
        $pendingIurans = Iuran::with('warga')
            ->where('rt_id', $rtId)
            ->where('status_pembayaran', 'Menunggu')
            ->orderBy('created_at', 'asc')
            ->get();

        // Data Tab 2: Riwayat
        $historyIurans = Iuran::with('warga')
            ->where('rt_id', $rtId)
            ->whereIn('status_pembayaran', ['Diterima', 'Ditolak'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // List Warga untuk Form Manual Input
        $wargas = Warga::where('rt_id', $rtId)->orderBy('nama')->get();

        return view('rt_page.iuran', compact(
            'rt',
            'totalPemasukan',
            'menungguKonfirmasi',
            'pendingIurans',
            'historyIurans',
            'wargas'
        ));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'jenis_iuran' => 'required|in:Mingguan,Bulanan',
            'biaya_iuran' => 'required|numeric|min:0',
        ]);

        $rt = Auth::user()->rt;
        $rt->update([
            'jenis_iuran' => $request->jenis_iuran,
            'biaya_iuran' => $request->biaya_iuran,
        ]);

        return redirect()->back()->with('success', 'Pengaturan iuran berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jumlah_pembayaran' => 'required|numeric|min:1000',
            'periode' => 'required|string',
        ]);

        Iuran::create([
            'warga_id' => $request->warga_id,
            'rt_id' => Auth::user()->rt->id,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'no_pembayaran' => 'INV-CASH-' . strtoupper(Str::random(6)),
            'periode' => $request->periode,
            'metode_pembayaran' => 'Cash',
            'status_pembayaran' => 'Diterima',
            'bukti_pembayaran' => null,
        ]);

        return redirect()->back()->with('success', 'Pembayaran tunai berhasil dicatat!');
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak'
        ]);

        $iuran = Iuran::where('rt_id', Auth::user()->rt->id)->findOrFail($id);

        $iuran->status_pembayaran = $request->status;
        $iuran->save();

        $message = $request->status == 'Diterima' ? 'Pembayaran berhasil diverifikasi.' : 'Pembayaran ditolak.';

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function storeWarga(Request $request){
        $user = Auth::user();
        $warga = $user->warga;

        $request->validate([
            'periode' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('bukti_iuran', 'public');
        }

        $nominal = $warga->rt->biaya_iuran;

        // 3. Simpan Data
        Iuran::create([
            'warga_id' => $warga->id,
            'rt_id' => $warga->rt_id,
            'jumlah_pembayaran' => $nominal,
            'no_pembayaran' => 'PAY-' . strtoupper(Str::random(8)),
            'periode' => $request->periode,
            'metode_pembayaran' => 'Digital',
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'Menunggu',
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil dikirim! Mohon tunggu verifikasi Admin RT.');
    }
}
