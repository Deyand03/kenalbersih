<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Akun - KenalBersih</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&family=Parisienne&display=swap"
        rel="stylesheet">

    {{-- AlpineJS --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-heading {
            font-family: 'Poppins', sans-serif;
        }

        .font-script {
            font-family: 'Parisienne', cursive;
        }

        /* Custom Scrollbar for Form Area */
        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 4px;
        }

        /* Animation */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-white h-screen w-full flex">

    {{-- Error Toast --}}
    @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="fixed top-5 left-1/2 -translate-x-1/2 z-50 w-full max-w-md bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg flex items-start gap-3"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 text-red-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h4 class="font-bold text-sm">Periksa Inputan Anda</h4>
                <ul class="list-disc list-inside text-xs mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button @click="show = false" class="ml-auto text-red-400 hover:text-red-600">&times;</button>
        </div>
    @endif

    {{-- Left Section --}}
    <div
        class="hidden lg:flex lg:w-[55%] relative bg-[#016B61] flex-col justify-between p-12 text-white overflow-hidden">

        <!-- Background Effects -->
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIj48ZmlsdGVyIGlkPSJhIj48ZmVUdXJYdWxlbmNlIHR5cGU9ImZyYWN0YWxOb2lzZSIgYmFzZUZyZXF1ZW5jeT0iLjY1IiBudW1PY3RhdmVzPSIzIiBzdGl0Y2hUaWxlcz0ic3RpdGNoIi8+PC9maWx0ZXI+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsdGVyPSJ1cmwoI2EpIi8+PC9zdmc+')] opacity-10 mix-blend-overlay">
        </div>
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-transparent to-black/20"></div>

        <!-- Decorative Circle -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>

        <!-- Branding Content -->
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-8">
                <div class="p-2 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                </div>
                <span class="text-xl font-heading font-bold tracking-wide">KenalBersih</span>
            </div>

            <div class="space-y-6 mt-10 mr-8">
                <h1 class="text-4xl xl:text-5xl font-heading font-bold leading-tight">
                    Sistem Informasi <br>
                    <span class="text-[#E1EEBC]">Pengelolaan Sampah</span>
                </h1>
                <p class="text-emerald-50/90 text-lg font-light leading-relaxed max-w-md">
                    Ubah data menjadi aksi nyata. Lacak volume sampah, jadwal angkut, dan iuran warga dalam satu
                    platform terpadu.
                </p>
            </div>
        </div>

        <!-- Footer Quote -->
        <div class="relative z-10 mt-auto pt-10 pr-20 flex items-center gap-4">
            <div class="h-px flex-1 bg-gradient-to-r from-white/50 to-transparent"></div>
            <p class="font-script text-2xl text-[#E1EEBC] animate-float">Teamwork makes the dream work</p>
        </div>

        <div
            class="absolute top-0 bottom-0 -right-1 w-full h-full pointer-events-none z-20 overflow-hidden flex justify-end">
            <svg viewBox="0 0 1000 1080" preserveAspectRatio="none" class="h-full w-auto text-white fill-current">
                <!-- Layer 1 (Opacity rendah buat efek bayangan) -->
                <path d="M1000 0H1000V1080H1000C850 1080 750 850 850 540C950 230 850 0 1000 0Z"
                    fill="rgba(255,255,255,0.1)" transform="translate(-20, 0)" />
                <!-- Main Wave (Warna Putih Solid) -->
                <path d="M1000 0H900C800 200 650 400 800 540C950 680 750 900 900 1080H1000V0Z" />
            </svg>
        </div>
    </div>

    {{-- Right Section --}}
    <div class="w-full lg:w-[45%] h-full relative bg-white overflow-y-auto">
        <div class="min-h-full flex flex-col justify-center items-center">
            <!-- Header Mobile (Muncul cuma di layar kecil) -->
            <div
                class="lg:hidden absolute top-0 left-0 w-full p-6 flex justify-between items-center bg-white z-20 border-b border-slate-100">
                <div class="flex items-center gap-2 text-[#016B61]">
                    <span class="font-heading font-bold text-lg">KenalBersih</span>
                </div>
            </div>

            <div class="w-full max-w-lg px-8 py-12 lg:px-12 relative z-10">

                <!-- Header Form -->
                <div class="text-center mb-10">
                    <p class="text-[#016B61] font-bold text-3xl mb-2">
                        K<span class="font-script font-normal">enal</span>&nbsp;B<span
                            class="font-script font-normal">ersih</span>
                    </p>
                    <h2 class="text-2xl font-heading font-bold text-slate-800 mb-2">Selamat Datang</h2>
                    <p class="text-slate-500 text-sm">Mari melangkah untuk menjaga lingkungan RT yang asri bersama.</p>
                </div>

                <form method="POST" action="{{ route('register.warga.store') }}" class="space-y-5">
                    @csrf

                    <!-- Grid 2 Kolom untuk Nama & Email -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nama -->
                        <div class="form-control">
                            <label for="name"
                                class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Nama
                                Lengkap</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                autofocus
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm focus:bg-white focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all outline-none placeholder-slate-400"
                                placeholder="Nama Sesuai KTP">
                        </div>

                        <!-- Email -->
                        <div class="form-control">
                            <label for="email"
                                class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm focus:bg-white focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all outline-none placeholder-slate-400"
                                placeholder="email@anda.com">
                        </div>
                    </div>

                    <!-- Grid 2 Kolom untuk Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5" x-data="{ showPass: false }">
                        <!-- Password -->
                        <div class="form-control relative">
                            <label for="password"
                                class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Password</label>
                            <div class="relative">
                                <input id="password" :type="showPass ? 'text' : 'password'" name="password" required
                                    autocomplete="new-password"
                                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm focus:bg-white focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all outline-none pr-10 placeholder-slate-400"
                                    placeholder="Min. 8 karakter">
                                <button type="button" @click="showPass = !showPass"
                                    class="absolute right-3 top-3.5 text-slate-400 hover:text-[#016B61] transition-colors">
                                    <svg x-show="!showPass" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <svg x-show="showPass" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                        viewBox="0 0 20 20" fill="currentColor" style="display:none">
                                        <path fill-rule="evenodd"
                                            d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                            clip-rule="evenodd" />
                                        <path
                                            d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.064 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm -->
                        <div class="form-control">
                            <label for="password_confirmation"
                                class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Konfirmasi</label>
                            <input id="password_confirmation" :type="showPass ? 'text' : 'password'"
                                name="password_confirmation" required
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm focus:bg-white focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all outline-none placeholder-slate-400"
                                placeholder="Ulangi password">
                        </div>
                    </div>

                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center"><span
                                class="bg-white px-4 text-xs text-slate-400 uppercase tracking-widest">Data
                                Warga</span>
                        </div>
                    </div>

                    <!-- Data Warga -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- RT -->
                        <div class="form-control">
                            <label for="rt_id"
                                class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Lingkungan
                                RT</label>
                            <div class="relative">
                                <select id="rt_id" name="rt_id" required
                                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm focus:bg-white focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all outline-none appearance-none">
                                    <option value="" disabled selected>Pilih RT Anda</option>
                                    @foreach ($daftar_rt as $rt)
                                        <option value="{{ $rt->id }}">RT {{ $rt->no_rt }}
                                            ({{ $rt->nama }})
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="form-control">
                            <label for="jenis_kelamin"
                                class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Jenis
                                Kelamin</label>
                            <div class="relative">
                                <select id="jenis_kelamin" name="jenis_kelamin" required
                                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm focus:bg-white focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all outline-none appearance-none">
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- No HP -->
                    <div class="form-control">
                        <label for="no_hp" class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">No.
                            WhatsApp</label>
                        <input id="no_hp" type="tel" name="no_hp" value="{{ old('no_hp') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm focus:bg-white focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all outline-none placeholder-slate-400"
                            placeholder="Contoh: 081234567890">
                    </div>

                    <!-- Alamat -->
                    <div class="form-control">
                        <label for="alamat_rumah"
                            class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Alamat Rumah</label>
                        <textarea id="alamat_rumah" name="alamat_rumah" rows="2" required
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm focus:bg-white focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all outline-none resize-none placeholder-slate-400"
                            placeholder="Nama Jalan, Blok, Nomor Rumah">{{ old('alamat_rumah') }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-[#5BA58B] to-[#016B61] hover:from-[#4a967a] hover:to-[#015a52] text-white font-bold py-4 px-4 rounded-xl shadow-lg shadow-[#016B61]/20 transition-all transform active:scale-[0.98] flex justify-center items-center gap-2">
                            <span>Bergabung Sekarang</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Footer Link -->
                    <p class="text-center text-sm text-slate-500 mt-6">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="font-bold text-[#016B61] hover:underline">Masuk di
                            sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
