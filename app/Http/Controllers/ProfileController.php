<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index_warga(){
        $user = Auth::user();
        $warga = $user->warga;

        return view('warga.profile', compact('user', 'warga'));
    }
    public function update_warga(Request $request)
    {
        $user = Auth::user();
        $warga = $user->warga;

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|numeric',
            'alamat_rumah' => 'required|string',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // 1. Update Data Warga
        $warga->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat_rumah' => $request->alamat_rumah,
        ]);

        // 2. Update Password User jika diisi
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
    public function index_rt()
    {
        $user = Auth::user();
        // Eager load relasi RT biar datanya kebawa
        $rt = $user->rt;

        return view('rt_page.profile', compact('user', 'rt'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $rt = $user->rt;

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|numeric', // Penting buat kontak warga
            'no_dana' => 'nullable|numeric', // Khusus E-Wallet
            'alamat_rumah' => 'required|string',
            'password' => 'nullable|min:6|confirmed', // Confirmed butuh input name="password_confirmation"
        ]);

        // 1. Update Data RT (Tabel 'rts')
        $rt->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'no_dana' => $request->no_dana,
            'alamat_rumah' => $request->alamat_rumah,
        ]);

        // 2. Update Password User (Tabel 'users') jika diisi
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
