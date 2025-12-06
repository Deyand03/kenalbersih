@extends('layouts.index')

@section('title', 'Profil Saya')

@section('content')
    {{-- LOGIC WARNA: Definisikan status di sini biar rapi --}}
    @php
        $status = Auth::user()->warga->status;
        $isAktif = $status === 'Aktif';

        // Warna Hex Utama (Hijau Tosca vs Merah Gelap) untuk elemen custom/inline style
        $mainColor = $isAktif ? '#016B61' : '#b91c1c';
    @endphp

    <div class="absolute top-0 left-0 right-0 h-140 overflow-hidden z-0 rounded-b-[3rem] shadow-2xl border-b border-white/10">
        {{-- Background Gradient Utama --}}
        <div class="absolute inset-0 bg-linear-to-br {{ $isAktif ? 'from-[#016B61] via-emerald-900 to-[#004d46]' : 'from-red-800 via-red-900 to-red-950' }}"></div>

        {{-- Orbs (Bola-bola cahaya background) --}}
        <div class="absolute -top-24 -right-24 w-140 h-140 {{ $isAktif ? 'bg-emerald-400/40' : 'bg-red-500/40' }} rounded-full blur-[100px] mix-blend-overlay animate-pulse">
        </div>
        <div class="absolute top-1/4 -left-24 w-100 h-100 {{ $isAktif ? 'bg-teal-300/20' : 'bg-rose-300/20' }} rounded-full blur-[80px] mix-blend-overlay">
        </div>
        <div class="absolute -bottom-32 left-1/4 w-full h-64 bg-linear-to-t {{ $isAktif ? 'from-emerald-500/30' : 'from-red-600/30' }} to-transparent blur-3xl">
        </div>

        {{-- Overlays --}}
        <div class="absolute inset-0 bg-white/2 backdrop-blur-[1px]"></div>
        <div class="absolute inset-0 opacity-30 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIj48ZmlsdGVyIGlkPSJhIj48ZmVUdXJYdWxlbmNlIHR5cGU9ImZyYWN0YWxOb2lzZSIgYmFzZUZyZXF1ZW5jeT0iLjY1IiBudW1PY3RhdmVzPSIzIiBzdGl0Y2hUaWxlcz0ic3RpdGNoIi8+PC9maWx0ZXI+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsdGVyPSJ1cmwoI2EpIi8+PC9zdmc+')] mix-blend-overlay">
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-px bg-linear-to-r from-transparent {{ $isAktif ? 'via-emerald-200/40' : 'via-red-200/40' }} to-transparent">
        </div>
    </div>

    {{-- WRAPPER UTAMA --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12 relative z-10">

        <!-- HERO CONTENT -->
        <div class="flex flex-col md:flex-row items-center justify-between mb-16 gap-8 animate-fade-in-up">
            <!-- Text -->
            <div class="text-center md:text-left space-y-4 max-w-2xl text-white">
                @if ($isAktif)
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md border border-white/20 text-emerald-50 text-xs font-bold tracking-wider mb-2 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                        WARGA AKTIF
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black tracking-tight leading-tight drop-shadow-lg">
                        Halo, <span class="text-emerald-200">{{ explode(' ', $warga->nama)[0] }}</span>! 👋
                    </h1>
                @else
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md border border-white/20 text-red-50 text-xs font-bold tracking-wider mb-2 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-red-400 animate-pulse"></span>
                        WARGA TIDAK AKTIF
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black tracking-tight leading-tight drop-shadow-lg">
                        Halo, <span class="text-red-200">{{ explode(' ', $warga->nama)[0] }}</span>! 👋
                    </h1>
                @endif

                {{-- Text deskripsi disesuaikan warnanya dikit --}}
                <p class="{{ $isAktif ? 'text-emerald-50' : 'text-red-50' }} text-lg leading-relaxed opacity-90 max-w-xl mx-auto md:mx-0 font-light">
                    Selamat datang di pusat kontrol profil Anda. Pantau status keanggotaan dan kelola data diri dengan mudah.
                </p>
            </div>

            <!-- Hero Stats (Hidden on small mobile, Flex on md up) -->
            <div class="hidden md:flex gap-5">
                <div class="w-36 h-36 bg-white/10 backdrop-blur-md rounded-3xl border border-white/20 flex flex-col items-center justify-center -rotate-6 shadow-xl transition-transform hover:rotate-0 duration-300 group cursor-default">
                    <span class="text-4xl mb-2 group-hover:scale-110 transition-transform">🏠</span>
                    <span class="text-white font-bold text-lg">RT {{ $warga->rt->no_rt }}</span>
                </div>
                <div class="w-36 h-36 bg-white/10 backdrop-blur-md rounded-3xl border border-white/20 flex flex-col items-center justify-center rotate-6 translate-y-6 shadow-xl transition-transform hover:rotate-0 hover:translate-y-0 duration-300 group cursor-default">
                    <span class="text-4xl mb-2 group-hover:scale-110 transition-transform">📅</span>
                    <span class="text-white font-bold text-xs uppercase text-center px-2 leading-tight opacity-90">Sejak<br><span
                            class="text-sm font-black">{{ $user->created_at->format('M Y') }}</span></span>
                </div>
            </div>
        </div>

        <!-- MAIN GRID CONTENT -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- KOLOM KIRI: DIGITAL MEMBER CARD -->
            <div class="lg:col-span-1 relative lg:sticky lg:top-24 animate-fade-in-up animation-delay-100 w-full max-w-sm mx-auto lg:max-w-none">
                <div class="relative w-full aspect-3/4 rounded-4xl overflow-hidden shadow-2xl transition-transform hover:scale-[1.02] duration-300 group ring-4 ring-white/20">

                    <!-- Background Card: Berubah saat di-hover sesuai status -->
                    <div class="absolute inset-0 bg-linear-to-br from-slate-800 to-slate-900 {{ $isAktif ? 'group-hover:from-[#016B61] group-hover:to-emerald-900' : 'group-hover:from-red-800 group-hover:to-red-950' }} transition-colors duration-500">
                    </div>
                    <div class="absolute inset-0 opacity-30 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIj48ZmlsdGVyIGlkPSJhIj48ZmVUdXJYdWxlbmNlIHR5cGU9ImZyYWN0YWxOb2lzZSIgYmFzZUZyZXF1ZW5jeT0iLjY1IiBudW1PY3RhdmVzPSIzIiBzdGl0Y2hUaWxlcz0ic3RpdGNoIi8+PC9maWx0ZXI+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsdGVyPSJ1cmwoI2EpIi8+PC9zdmc+')] mix-blend-overlay">
                    </div>

                    <!-- Card Content -->
                    <div class="relative z-10 h-full flex flex-col p-7 text-white justify-between">
                        <!-- Top -->
                        <div class="flex justify-between items-start">
                            <div class="w-12 h-9 bg-linear-to-br from-amber-200 to-amber-500 rounded-lg shadow-lg border border-amber-300/50 relative overflow-hidden">
                                <div class="absolute inset-0 bg-black/10"
                                    style="background-image: repeating-linear-gradient(45deg, transparent, transparent 2px, rgba(0,0,0,0.1) 2px, rgba(0,0,0,0.1) 4px);">
                                </div>
                            </div>
                            <div class="text-right">
                                <h3 class="font-bold text-lg tracking-widest uppercase opacity-90 drop-shadow-md">
                                    KenalBersih</h3>
                                <p class="text-[9px] opacity-75 tracking-[0.2em]">MEMBER CARD</p>
                            </div>
                        </div>

                        <!-- Middle -->
                        <div class="text-center my-auto relative">
                            <div class="w-24 h-24 mx-auto bg-white/10 backdrop-blur-md rounded-full p-1 shadow-2xl border border-white/20 mb-4 relative">
                                <div class="w-full h-full bg-slate-100 text-slate-700 rounded-full flex items-center justify-center text-3xl font-black shadow-inner">
                                    {{ substr($warga->nama, 0, 2) }}
                                </div>
                                {{-- Status Dot Indicator --}}
                                <div class="absolute bottom-1 right-1 w-5 h-5 {{ $isAktif ? 'bg-emerald-500' : 'bg-red-500' }} border-2 border-slate-800 rounded-full shadow-lg animate-pulse"
                                    title="{{ $status }}"></div>
                            </div>
                            <h2 class="text-2xl font-bold tracking-tight text-white drop-shadow-md line-clamp-1">
                                {{ $warga->nama }}</h2>
                            <div class="inline-block bg-white/10 backdrop-blur-md px-4 py-1.5 rounded-full text-[10px] font-bold mt-3 border border-white/10 shadow-sm tracking-widest uppercase">
                                Warga RT {{ $warga->rt->no_rt ?? '-' }}
                            </div>
                        </div>

                        <!-- Bottom -->
                        <div class="space-y-2 pt-4 border-t border-white/10">
                            <div class="flex justify-between text-xs opacity-90">
                                <span class="font-light tracking-wide uppercase text-white/50">ID Warga</span>
                                <span class="font-mono font-medium tracking-wider text-shadow-sm {{ $isAktif ? 'text-emerald-300' : 'text-red-300' }}">{{ sprintf('%04d %04d %04d', $warga->rt_id, $warga->id, rand(1000, 9999)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Micro Stats -->
                <div class="mt-6 grid grid-cols-2 gap-4">
                    <div class="bg-white p-4 rounded-3xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-all hover:-translate-y-1 cursor-default">
                        <div class="{{ $isAktif ? 'text-[#016B61]' : 'text-red-700' }} font-black text-3xl">
                            {{ $warga->iuran->where('status_pembayaran', 'Diterima')->count() }}</div>
                        <div class="text-[10px] text-slate-400 uppercase font-bold tracking-wider mt-1">Iuran Lunas</div>
                    </div>
                    <div class="bg-white p-4 rounded-3xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-all hover:-translate-y-1 cursor-default">
                        <div class="text-orange-500 font-black text-3xl">{{ $warga->laporan_sampah->count() }}</div>
                        <div class="text-[10px] text-slate-400 uppercase font-bold tracking-wider mt-1">Laporan</div>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: FORM EDIT -->
            <div class="lg:col-span-2 animate-fade-in-up animation-delay-200">
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Bagian 1: Data Diri -->
                    <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                        {{-- Background accent pojok kanan form --}}
                        <div class="absolute top-0 right-0 w-40 h-40 {{ $isAktif ? 'bg-emerald-50' : 'bg-red-50' }} rounded-bl-full -mr-10 -mt-10 pointer-events-none">
                        </div>

                        <div class="flex items-center gap-5 mb-8 relative z-10">
                            {{-- Icon Header Form --}}
                            <div class="w-14 h-14 rounded-2xl bg-linear-to-br {{ $isAktif ? 'from-emerald-50 to-emerald-100 text-[#016B61] border-emerald-100' : 'from-red-50 to-red-100 text-red-700 border-red-100' }} flex items-center justify-center shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-slate-800">Informasi Pribadi</h3>
                                <p class="text-slate-500">Perbarui data diri agar mudah dihubungi.</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- Nama -->
                            <div class="form-control">
                                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ old('nama', $warga->nama) }}"
                                    class="w-full rounded-2xl border-slate-200 text-slate-700 px-6 py-4 focus:ring-4 {{ $isAktif ? 'focus:ring-emerald-100 focus:border-[#016B61] hover:border-emerald-300' : 'focus:ring-red-100 focus:border-red-600 hover:border-red-300' }} transition-all font-bold placeholder-slate-300 bg-slate-50/50 focus:bg-white outline-none"
                                    placeholder="Nama sesuai KTP">
                                @error('nama')
                                    <span class="text-red-500 text-xs mt-2 ml-1 font-medium block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- No HP -->
                                <div class="form-control">
                                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">No. WhatsApp</label>
                                    <div class="relative group">
                                        <span class="absolute left-5 top-4 text-slate-400 {{ $isAktif ? 'group-focus-within:text-[#016B61]' : 'group-focus-within:text-red-600' }} transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                            </svg>
                                        </span>
                                        <input type="number" name="no_hp" value="{{ old('no_hp', $warga->no_hp) }}"
                                            class="w-full rounded-2xl border-slate-200 text-slate-700 pl-14 pr-4 py-4 focus:ring-4 {{ $isAktif ? 'focus:ring-emerald-100 focus:border-[#016B61] hover:border-emerald-300' : 'focus:ring-red-100 focus:border-red-600 hover:border-red-300' }} transition-all font-bold placeholder-slate-300 bg-slate-50/50 focus:bg-white outline-none"
                                            placeholder="0812...">
                                    </div>
                                    @error('no_hp')
                                        <span class="text-red-500 text-xs mt-2 ml-1 font-medium block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email (Read Only) -->
                                <div class="form-control">
                                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Email Akun</label>
                                    <div class="relative">
                                        <span class="absolute left-5 top-4 text-slate-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                            </svg>
                                        </span>
                                        <input type="text" value="{{ $user->email }}" disabled
                                            class="w-full rounded-2xl border-slate-200 bg-slate-100 text-slate-500 pl-14 pr-4 py-4 cursor-not-allowed font-medium border-dashed">
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="form-control">
                                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Alamat Rumah</label>
                                <textarea name="alamat_rumah" rows="2"
                                    class="w-full rounded-2xl border-slate-200 text-slate-700 px-6 py-4 focus:ring-4 {{ $isAktif ? 'focus:ring-emerald-100 focus:border-[#016B61] hover:border-emerald-300' : 'focus:ring-red-100 focus:border-red-600 hover:border-red-300' }} transition-all resize-none placeholder-slate-300 bg-slate-50/50 focus:bg-white outline-none font-medium"
                                    placeholder="Alamat lengkap di lingkungan RT">{{ old('alamat_rumah', $warga->alamat_rumah) }}</textarea>
                                @error('alamat_rumah')
                                    <span class="text-red-500 text-xs mt-2 ml-1 font-medium block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 2: Keamanan (Warna Orange tetap dipertahankan karena netral untuk keamanan) -->
                    <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-orange-50 rounded-bl-full -mr-10 -mt-10 pointer-events-none">
                        </div>

                        <div class="flex items-center gap-5 mb-8 relative z-10">
                            <div class="w-14 h-14 rounded-2xl bg-linear-to-br from-orange-50 to-orange-100 flex items-center justify-center text-orange-500 shadow-sm border border-orange-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-slate-800">Ubah Password</h3>
                                <p class="text-slate-500">Jaga keamanan akun Anda secara berkala.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Password Baru</label>
                                <input type="password" name="password"
                                    class="w-full rounded-2xl border-slate-200 text-slate-700 px-6 py-4 focus:ring-4 focus:ring-orange-100 focus:border-orange-400 transition-all placeholder-slate-300 bg-slate-50/50 focus:bg-white hover:border-orange-200 outline-none font-bold"
                                    placeholder="Min. 6 karakter">
                                @error('password')
                                    <span class="text-red-500 text-xs mt-2 ml-1 font-medium block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full rounded-2xl border-slate-200 text-slate-700 px-6 py-4 focus:ring-4 focus:ring-orange-100 focus:border-orange-400 transition-all placeholder-slate-300 bg-slate-50/50 focus:bg-white hover:border-orange-200 outline-none font-bold"
                                    placeholder="Ulangi password">
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="btn {{ $isAktif ? 'bg-[#016B61] hover:bg-[#015a52] shadow-[#016B61]/30' : 'bg-red-700 hover:bg-red-800 shadow-red-700/30' }} text-white border-none px-10 py-4 h-auto rounded-2xl font-bold tracking-wide shadow-xl transition-all hover:scale-[1.02] active:scale-95 flex items-center gap-3 text-lg w-full md:w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @vite(['resources/js/utility/profile.js', 'resources/css/style.css'])

    {{-- SweetAlert --}}
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Profil Diperbarui!',
                text: '{{ session('success') }}',
                confirmButtonColor: '{{ $mainColor }}', // Warna dinamis dari PHP di atas
                timer: 3000,
                background: '#fff',
                iconColor: '{{ $mainColor }}', // Warna dinamis
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'rounded-xl px-6 py-3'
                }
            });
        </script>
    @endif
@endsection
