@extends('layouts.index')
@section('title', 'Homepage')

@section('content')
    {{-- Splash Screen --}}
    <div id="splash-screen">
        <div class="splash-container">
            <svg class="splash-leaf" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path class="leaf-path" d="M50 90 V 40" stroke-dasharray="50" stroke-dashoffset="50"
                    style="animation-delay: 0s;" />
                <path class="leaf-path" d="M50 70 C 40 65, 30 55, 30 40" stroke-dasharray="55" stroke-dashoffset="55"
                    style="animation-delay: 0.3s;" />
                <path class="leaf-path" d="M50 70 C 60 65, 70 55, 70 40" stroke-dasharray="55" stroke-dashoffset="55"
                    style="animation-delay: 0.3s;" />
                <path class="leaf-path" d="M50 55 C 42 50, 35 40, 35 25" stroke-dasharray="50" stroke-dashoffset="50"
                    style="animation-delay: 0.6s;" />
                <path class="leaf-path" d="M50 55 C 58 50, 65 40, 65 25" stroke-dasharray="50" stroke-dashoffset="50"
                    style="animation-delay: 0.6s;" />
            </svg>
            <h3 class="splash-text">KenalBersih</h3>
        </div>
    </div>

    <div class="w-full max-w-[100vw] overflow-x-hidden">
        {{-- Hero Page --}}
        <div class="relative w-full pt-20 overflow-hidden bg-cover bg-center"
            style="background-image: url({{ asset('svg/Bg-homepage.svg') }})">
            <div class="relative z-10 h-full">
                <div
                    class="flex flex-col md:flex-row pt-8 md:pt-20 px-8 md:px-24 max-w-8xl mx-auto items-center min-h-[70vh] pb-32 md:pb-48">
                    <div class="text-black/80 md:w-1/2 flex flex-col">
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-8 leading-tight" data-animasi="fade-right"
                            data-delay="200">
                            Sistem Pengelolaan Sampah RT
                        </h1>
                        <h2 class="text-xl md:text-2xl lg:text-3xl font-semibold text-(--text-secondary) mb-4"
                            data-animasi="fade-right" data-delay="400">Desa Mendalo Indah</h2>
                        <p class="font-medium text-md md:text-lg text-black/70" data-animasi="fade-right" data-delay="600">
                            Lacak jadwal angkut, laporkan tumpukan sampah, dan pantau iuran warga dalam satu
                            platform. KenalBersih hadir untuk memudahkan kolaborasi warga dan pengurus RT.
                        </p>

                        <a href="#volume-sampah"
                            class="mt-12 inline-block bg-[#44BB91] text-[#201E43] font-bold py-3 px-8 rounded-full text-lg shadow-lg transition-all duration-300 hover:scale-105 hover:bg-[#E1EEBC] w-fit"
                            data-animasi="fade-up" data-delay="800">
                            Lihat Volume Sampah
                        </a>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-px left-0 w-full z-0">
                <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                    <path
                        d="M0 48C144 48 288 96 432 96C576 96 720 48 864 48C1008 48 1152 96 1296 96C1368 96 1440 48 1440 48V120H0V48Z"
                        fill="#F1FCFF" />
                </svg>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="relative bg-[#F1FCFF] w-full h-fit">
            <div class="relative h-fit pt-20 pb-20 px-10 md:px-20">
                <div class="max-w-5xl mx-auto mb-20 md:mb-32">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                        <div class="bg-white p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105"
                            data-animasi="fade-up">
                            <h3 class="text-4xl lg:text-5xl font-bold text-[#016B61]" id="stat-warga"
                                data-total-warga="{{ $jumlahWarga }}">0</h3>
                            <p class="text-lg text-gray-600 mt-2">Warga Terdaftar</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105"
                            data-animasi="fade-up" data-delay="200">
                            <h3 class="text-4xl lg:text-5xl font-bold text-[#016B61]" id="stat-rt"
                                data-total-rt="{{ json_encode($allRts->count() ) }}">0</h3>
                            <p class="text-lg text-gray-600 mt-2">RT Terlayani</D>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105"
                            data-animasi="fade-up" data-delay="400">
                            <h3 class="text-4xl lg:text-5xl font-bold text-[#016B61]" id="stat-sampah"
                                data-sampah-terkelola="{{ json_encode($totalSampahTerkelola) }}">0 <span
                                    class="text-3xl">Kg</span></h3>
                            <p class="text-lg text-gray-600 mt-2">Sampah Terkelola</p>
                        </div>
                    </div>
                </div>

                {{-- Form Filter--}}
                <form action="{{ route('homepage') }}#volume-sampah" method="get"
                    class="flex flex-col md:flex-row gap-4 lg:gap-6 items-end bg-white p-6 rounded-xl shadow-lg max-w-3xl mx-auto"
                    data-animasi="fade-up">
                    <div class="flex flex-col md:flex-row items-center gap-3 w-full">
                        <div class="w-full md:flex-1">
                            <label for="rt-select" class="font-semibold text-lg text-gray-700">Masukan No RT:</label>
                            <select
                                class="select w-full mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#328E6E] focus:border-[#328E6E] transition-all"
                                name="rt_id" id="rt-select">
                                @foreach ($allRts as $rt)
                                    <option value="{{ $rt->no_rt }}" {{ $rt->id == $selectedRtId ? 'selected' : '' }}>
                                        RT {{ $rt->no_rt }} - ({{ $rt->nama }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:flex-1">
                            <label for="tahun-select" class="font-semibold text-lg text-gray-700">Pilih Tahun:</label>
                            <select
                                class="select w-full mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#328E6E] focus:border-[#328E6E] transition-all"
                                name="tahun" id="tahun-select">
                                @forelse ($listTahun as $tahun)
                                    <option value="{{ $tahun }}" {{ $tahun == $selectedTahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @empty
                                    <option value="">Data tahun tidak tersedia</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="w-full md:w-auto flex justify-end">
                        <button
                            class="w-full bg-[#44BB91] text-white font-bold rounded-lg px-6 py-2 transition-all duration-300 ease-in-out hover:scale-105 hover:bg-[#328E6E] hover:shadow-md active:scale-100 transform-gpu will-change-transform disabled:bg-gray-400 disabled:cursor-not-allowed disabled:hover:scale-100"
                            type="submit" id="button-filter">Tampilkan</button>
                    </div>
                </form>

                {{-- Volume Sampah Section --}}
                <div class="flex flex-col items-center pb-12">
                    <h1 class="text-center text-3xl md:text-[2.5rem] font-bold mb-1 text-black/75 pt-16" id="volume-sampah"
                        data-animasi="fade-down">
                        Volume Sampah
                    </h1>
                    <div style="background-image: url({{ asset('svg/divider.svg') }})"
                        class="object-cover bg-no-repeat bg-center w-12 rounded md:w-50 h-[5px]"></div>
                </div>


                {{-- Component Chart --}}
                <x-chart :dataBulanan="$dataBulanan"></x-chart>

                {{-- Component Kalender Jadwal --}}
                <x-jadwal></x-jadwal>

            </div>
        </div>
    </div>

    @vite([
        'resources/js/homepage.js',
        'resources/js/utility/fetch_tahun.js',
        'resources/js/utility/chart_homepage.js',
        'resources/js/utility/jadwal_angkut.js'
    ])
@endsection
