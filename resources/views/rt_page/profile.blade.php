@extends('layouts.sidebar')

@section('title', 'Profil Pengurus RT')

@section('content')
<div class="max-w-6xl mx-auto">

    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Pengaturan Profil</h1>
        <p class="text-slate-500 text-sm mt-1">Kelola informasi kontak, akun DANA, dan keamanan akun RT Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- KOLOM KIRI: KARTU IDENTITAS (Static Preview) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden sticky top-8">
                <!-- Banner Background -->
                <div class="h-24 bg-linear-to-r from-[#016B61] to-emerald-500"></div>

                <div class="px-6 pb-6 text-center relative">
                    <!-- Avatar -->
                    <div class="w-24 h-24 mx-auto -mt-12 bg-white rounded-full p-1 shadow-md">
                        <div class="w-full h-full bg-slate-100 rounded-full flex items-center justify-center text-2xl font-bold text-[#016B61] border border-slate-100">
                            {{ substr($rt->nama, 0, 2) }}
                        </div>
                    </div>

                    <h2 class="mt-4 text-lg font-bold text-slate-800">{{ $rt->nama }}</h2>
                    <div class="badge bg-emerald-100 text-emerald-700 border-none mt-2 font-medium">Pengurus RT {{ $rt->no_rt }}</div>

                    <div class="mt-6 space-y-3 text-left">
                        <div class="flex items-center gap-3 text-sm text-slate-600 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <svg class="w-5 h-5 text-[#016B61]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></path></svg>
                            <span class="truncate">{{ $rt->no_hp ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-slate-600 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></path></svg>
                            <div class="flex flex-col">
                                <span class="text-xs text-slate-400 font-bold">No. DANA</span>
                                <span class="font-mono font-bold text-slate-700">{{ $rt->no_dana ?? 'Belum diatur' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: FORM EDIT -->
        <div class="lg:col-span-2">
            <form action="{{ route('rt.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Card: Informasi Umum -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-50">
                        <div class="p-2 bg-emerald-50 rounded-lg text-[#016B61]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Informasi Wilayah & Kontak</h3>
                            <p class="text-xs text-slate-500">Data ini akan dilihat oleh warga.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama RT/Alias -->
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-slate-600 mb-2">Nama Ketua/Alias RT</label>
                            <input type="text" name="nama" value="{{ old('nama', $rt->nama) }}"
                                class="w-full rounded-xl border-slate-200 text-slate-700 focus:ring-2 focus:ring-[#016B61] focus:border-transparent px-4 py-3 transition-all font-medium"
                                placeholder="Contoh: Paguyuban RT 01">
                            @error('nama') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- No HP -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-2">No. WhatsApp Pengurus</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></path></svg>
                                </span>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $rt->no_hp) }}"
                                    class="w-full rounded-xl border-slate-200 text-slate-700 pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all font-mono"
                                    placeholder="0812...">
                            </div>
                            @error('no_hp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- No DANA -->
                        <div>
                            <label class="flex text-sm font-semibold text-slate-600 mb-2 justify-between">
                                <span>No. DANA (E-Wallet)</span>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" class="h-4" alt="Dana">
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></path></svg>
                                </span>
                                <input type="text" name="no_dana" value="{{ old('no_dana', $rt->no_dana) }}"
                                    class="w-full rounded-xl border-slate-200 text-slate-700 pl-12 pr-4 py-3 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all font-mono"
                                    placeholder="Nomor terdaftar di DANA">
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1">*Nomor ini akan muncul saat warga membayar iuran via Digital.</p>
                            @error('no_dana') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-slate-600 mb-2">Alamat Sekretariat / Rumah RT</label>
                            <textarea name="alamat_rumah" rows="3" class="w-full rounded-xl border-slate-200 text-slate-700 focus:ring-2 focus:ring-[#016B61] focus:border-transparent px-4 py-3 transition-all">{{ old('alamat_rumah', $rt->alamat_rumah) }}</textarea>
                            @error('alamat_rumah') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Card: Keamanan -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-50">
                        <div class="p-2 bg-rose-50 rounded-lg text-rose-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Keamanan Akun</h3>
                            <p class="text-xs text-slate-500">Kosongkan jika tidak ingin mengubah password.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-2">Password Baru</label>
                            <input type="password" name="password"
                                class="w-full rounded-xl border-slate-200 focus:ring-2 focus:ring-rose-400 focus:border-transparent px-4 py-3 transition-all"
                                placeholder="Minimal 6 karakter">
                            @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                class="w-full rounded-xl border-slate-200 focus:ring-2 focus:ring-rose-400 focus:border-transparent px-4 py-3 transition-all"
                                placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="submit" class="btn bg-[#016B61] hover:bg-[#015a52] text-white border-none px-8 py-3 rounded-xl shadow-lg shadow-emerald-500/30 h-auto font-bold tracking-wide transition-transform active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- SweetAlert untuk Notifikasi --}}
@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#016B61',
            timer: 3000
        });
    </script>
@endif
@endsection
