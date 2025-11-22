<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk - KenalBersih</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&family=Parisienne&display=swap" rel="stylesheet">

    {{-- AlpineJS --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-heading { font-family: 'Poppins', sans-serif; }
        .font-script { font-family: 'Parisienne', cursive; }

        /* Custom Scrollbar */
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 4px; }
    </style>
</head>

<body class="bg-white min-h-screen w-full overflow-hidden relative">

    {{-- Error Toast --}}
    @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-5 left-1/2 -translate-x-1/2 z-50 w-[90%] max-w-md bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg flex items-start gap-3 shadow-red-100"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <div>
                <h4 class="font-bold text-sm">Login Gagal</h4>
                <ul class="list-disc list-inside text-xs mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button @click="show = false" class="ml-auto text-red-400 hover:text-red-600">&times;</button>
        </div>
    @endif

    <div class="hidden lg:block absolute top-0 left-0 h-full w-[55%] z-0 pointer-events-none">
        <svg width="100%" height="100%" viewBox="0 0 1198 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg" class="drop-shadow-2xl">
            <path d="M0 1080V0H1198C1198 0 1012.35 65.5607 959.801 92.5857C851.839 148.114 777.529 240.422 778.15 361.835C778.7 469.515 863.04 516.049 940.785 590.547C1048.38 693.642 1123.32 718.759 1166.47 854.291C1192.56 936.232 1156.97 1080 1156.97 1080H0Z" fill="url(#paint0_linear_124_2)"/>
            <defs>
                <linearGradient id="paint0_linear_124_2" x1="168.641" y1="104.597" x2="995.407" y2="942.798" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#5BA58B"/>
                    <stop offset="1" stop-color="#201E43"/>
                </linearGradient>
            </defs>
        </svg>
    </div>

    <div class="relative z-10 w-full h-screen flex flex-col lg:flex-row">

        {{-- KIRI: Branding --}}
        <div class="hidden lg:flex lg:w-[45%] flex-col justify-center px-16 xl:px-24 text-white h-full sticky top-0">
            <div>
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-2 bg-white/10 backdrop-blur-sm rounded-lg border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <span class="text-2xl font-bold tracking-wide font-heading">KenalBersih</span>
                </div>

                <h1 class="text-5xl font-bold font-heading leading-tight mb-6">
                    Selamat Datang <br>
                    <span class="text-[#E1EEBC]">Kembali!</span>
                </h1>

                <p class="text-lg text-emerald-50/90 font-light leading-relaxed max-w-lg mb-10">
                    Lanjutkan kontribusi Anda untuk lingkungan yang lebih bersih dan teratur. Masuk untuk mengakses dasbor warga.
                </p>

                <div class="flex items-center gap-4">
                    <div class="h-[1px] w-12 bg-[#E1EEBC]"></div>
                    <p class="text-[#E1EEBC] italic font-medium">Welcome back, neighbor!</p>
                </div>
            </div>
        </div>

        {{--
            KANAN: Form Login (FIXED SCROLL)
        --}}
        <div class="w-full lg:w-[54%] h-full bg-white/90 lg:bg-transparent overflow-y-auto custom-scroll">

            {{-- Wrapper --}}
            <div class="min-h-full w-full flex flex-col justify-center items-center py-10 lg:py-0">

                {{-- Mobile Header --}}
                <div class="lg:hidden w-full bg-gradient-to-r from-[#5BA58B] to-[#201E43] p-6 text-white mb-8 shrink-0">
                    <h2 class="text-2xl font-bold font-heading">KenalBersih</h2>
                    <p class="text-xs opacity-80">Masuk ke akun warga</p>
                </div>

                <div class="w-full max-w-md px-8">

                    <div class="text-center lg:text-left mb-8">
                        <p class="text-3xl font-bold text-[#016B61] mb-2 lg:hidden">
                            K<span class="font-script font-normal">enal</span>&nbsp;B<span class="font-script font-normal">ersih</span>
                        </p>
                        <h2 class="text-3xl font-heading font-bold text-slate-800 mb-2">Masuk Akun 👋</h2>
                        <p class="text-slate-500 text-sm">Masukkan kredensial Anda untuk melanjutkan.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <div class="form-control">
                            <label for="email" class="block text-xs font-bold text-slate-600 uppercase mb-2 ml-1 tracking-wider">Email</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-3.5 text-slate-400 group-focus-within:text-[#016B61] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                </span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm focus:bg-white focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all outline-none placeholder-slate-400"
                                    placeholder="email@anda.com">
                            </div>
                        </div>

                        <div class="form-control" x-data="{ showPass: false }">
                            <div class="flex justify-between items-center mb-2 ml-1">
                                <label for="password" class="block text-xs font-bold text-slate-600 uppercase tracking-wider">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-xs text-[#016B61] hover:underline font-medium">Lupa password?</a>
                                @endif
                            </div>
                            <div class="relative group">
                                <span class="absolute left-4 top-3.5 text-slate-400 group-focus-within:text-[#016B61] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                </span>
                                <input id="password" :type="showPass ? 'text' : 'password'" name="password" required autocomplete="current-password"
                                    class="w-full pl-12 pr-12 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm focus:bg-white focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all outline-none placeholder-slate-400"
                                    placeholder="Masukkan password">
                                <button type="button" @click="showPass = !showPass" class="absolute right-4 top-3.5 text-slate-400 hover:text-[#016B61] transition-colors focus:outline-none">
                                    <svg x-show="!showPass" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                    <svg x-show="showPass" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                                <div class="relative">
                                    <input id="remember_me" type="checkbox" class="sr-only peer" name="remember">
                                    <div class="w-5 h-5 border-2 border-slate-300 rounded peer-checked:bg-[#016B61] peer-checked:border-[#016B61] transition-all"></div>
                                    <svg class="w-3.5 h-3.5 text-white absolute top-0.5 left-0.5 opacity-0 peer-checked:opacity-100 transition-opacity" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <span class="ms-2 text-sm text-slate-500 group-hover:text-slate-700 transition-colors">{{ __('Ingat saya') }}</span>
                            </label>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full bg-gradient-to-r from-[#5BA58B] to-[#016B61] hover:from-[#4a967a] hover:to-[#015a52] text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-emerald-900/20 transition-all transform active:scale-[0.98] flex justify-center items-center gap-2">
                                <span>Masuk Sekarang</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                            </button>
                        </div>

                        <p class="text-center text-sm text-slate-500 mt-6">
                            Belum memiliki akun?
                            <a href="{{ route('register.warga') }}" class="font-bold text-[#016B61] hover:underline hover:text-[#201E43] transition-colors">Daftar di sini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
