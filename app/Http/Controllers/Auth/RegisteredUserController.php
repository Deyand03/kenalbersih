<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rt;
use App\Models\Warga;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register-rt');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi semua input
        $request->validate([
            // Validasi untuk data di tabel 'rts'
            'name' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'no_rt' => ['required', 'integer', 'unique:rts'],
            'alamat_rumah' => ['required', 'string', 'max:255'],
            'no_rekening' => ['nullable', 'string', 'max:255', 'unique:rts'],
            'no_dana' => ['nullable', 'string', 'max:255', 'unique:rts'],
            'no_hp' => ['required', 'string', 'max:255', 'unique:rts'],

            // Validasi untuk data di tabel 'users'
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Buat User (HANYA untuk data login, TANPA 'name')
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'rt',
        ]);

        // 3. Buat Data Profil RT (dan hubungkan dengan user_id)
        $rt = Rt::create([
            'user_id' => $user->id, // <-- Kunci penghubung
            'nama' => $request->name, // <-- 'name' disimpan di sini
            'no_rt' => $request->no_rt,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_rekening' => $request->no_rekening,
            'alamat_rumah' => $request->alamat_rumah,
            'no_dana' => $request->no_dana,
            'no_hp' => $request->no_hp,
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Menampilkan view registrasi WARGA.
     */
    public function createWarga(): View
    {
        // Ambil daftar RT dari MODEL 'Rt'
        $daftar_rt = Rt::select('id', 'nama', 'no_rt')->get();

        return view('auth.register-warga', [
            'daftar_rt' => $daftar_rt
        ]);
    }

    /**
     * Menangani request registrasi WARGA.
     */
    public function storeWarga(Request $request): RedirectResponse
    {
        // Validasi untuk Warga (sesuai tabel 'wargas' Anda)
        $request->validate([
            // Data untuk tabel 'wargas'
            'name' => ['required', 'string', 'max:255'],
            'rt_id' => ['required', 'integer', Rule::exists('rts', 'id')], // Cek ID-nya ada di tabel 'rts'
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat_rumah' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:255'],

            // Data untuk tabel 'users'
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 1. Buat User (untuk data login, TANPA 'name')
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'warga',
        ]);

        // 2. Buat Data Profil Warga (dan hubungkan)
        $warga = Warga::create([
            'user_id' => $user->id, // Penghubung ke tabel 'users'
            'rt_id' => $request->rt_id, // Penghubung ke tabel 'rts'
            'nama' => $request->name, // <-- 'name' disimpan di sini
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_rumah' => $request->alamat_rumah,
            'no_hp' => $request->no_hp,
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(route('dashboard', absolute: false));
    }
}
