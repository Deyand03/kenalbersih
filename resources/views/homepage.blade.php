@extends('layouts.index')
@section('title', 'Homepage')

@section('content')
    <div class="w-full max-w-[100vw] overflow-x-hidden">

        {{-- Hero Page --}}
        <div class="relative w-full pt-20 overflow-hidden bg-cover bg-center"
            style="background-image: url({{ asset('svg/Bg-homepage.svg') }})">
            <div class="relative z-10 h-full">
                <div
                    class="flex flex-col md:flex-row pt-10 px-6 md:px-10 lg:px-20 max-w-7xl mx-auto items-center min-h-[70vh] pb-32 md:pb-48">
                    <div class="text-black/80 md:w-1/2 flex flex-col">
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-8 leading-tight" data-animasi="fade-right"
                            data-delay="200">
                            Sistem Pengelolaan Sampah RT
                        </h1>
                        <h2 class="text-xl md:text-2xl lg:text-3xl font-semibold text-[#828d66] mb-4"
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
                            data-totalWarga="{{ $jumlah_warga }}">0</h3>
                            <p class="text-lg text-gray-600 mt-2">Warga Terdaftar</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105"
                            data-animasi="fade-up" data-delay="200">
                            <h3 class="text-4xl lg:text-5xl font-bold text-[#016B61]" id="stat-rt"
                            data-totalRt="{{ json_encode($all_rts) }}">0</h3>
                            <p class="text-lg text-gray-600 mt-2">RT Terlayani</D>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105"
                            data-animasi="fade-up" data-delay="400">
                            <h3 class="text-4xl lg:text-5xl font-bold text-[#016B61]" id="stat-sampah"
                            data-sampahTerkelola="{{ json_encode($totalSampahTerkelola) }}">0 <span
                                    class="text-3xl">Kg</span></h3>
                            <p class="text-lg text-gray-600 mt-2">Sampah Terkelola</p>
                        </div>
                    </div>
                </div>

                {{-- Fitur --}}
                {{-- <div class="max-w-5xl mx-auto mb-20 md:mb-32">
                    <div class="flex flex-col items-center pb-12">
                        <h1 class="text-center text-3xl md:text-[2.5rem] font-bold mb-1 text-black/75"
                            data-animasi="fade-down">
                            Fitur Unggulan
                        </h1>
                        <div style="background-image: url({{ asset('svg/divider.svg') }})"
                            class="object-cover bg-no-repeat bg-center w-12 rounded md:w-50 h-[5px]"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white p-8 rounded-xl shadow-lg text-center transform transition-all duration-300 hover:shadow-xl hover:-translate-y-2"
                            data-animasi="zoom-in">
                            <svg class="w-16 h-16 mx-auto mb-4 text-[#44BB91]" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                            <h4 class="text-2xl font-bold text-gray-800 mb-2">Lapor Sampah</h4>
                            <p class="text-gray-600">Laporkan tumpukan sampah liar dengan mudah dan cepat.</p>
                        </div>
                        <div class="bg-white p-8 rounded-xl shadow-lg text-center transform transition-all duration-300 hover:shadow-xl hover:-translate-y-2"
                            data-animasi="zoom-in" data-delay="200">
                            <svg class="w-16 h-16 mx-auto mb-4 text-[#44BB91]" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            <h4 class="text-2xl font-bold text-gray-800 mb-2">Lacak Jadwal</h4>
                            <p class="text-gray-600">Lihat jadwal pengangkutan sampah mingguan untuk RT kamu.</p>
                        </div>
                        <div class="bg-white p-8 rounded-xl shadow-lg text-center transform transition-all duration-300 hover:shadow-xl hover:-translate-y-2"
                            data-animasi="zoom-in" data-delay="400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-cash-stack w-16 h-16 mx-auto mb-4 text-[#44BB91]" viewBox="0 0 16 16">
                                <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                <path
                                    d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                            </svg>
                            <h4 class="text-2xl font-bold text-gray-800 mb-2">Pantau Iuran</h4>
                            <p class="text-gray-600">Cek status pembayaran iuran kebersihan secara transparan.</p>
                        </div>
                    </div>
                </div> --}}

                {{-- Form Filter--}}
                <form action="{{ route('homepage') }}#volume-sampah" method="get"
                    class="flex flex-col md:flex-row gap-4 lg:gap-6 items-center mb-12 bg-white p-6 rounded-xl shadow-lg max-w-3xl mx-auto"
                    data-animasi="fade-up">

                    <div class="w-full md:flex-1">
                        <label for="rt-select" class="font-semibold text-lg text-gray-700">Masukan No RT:</label>
                        <select
                            class="select w-full mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#328E6E] focus:border-[#328E6E] transition-all"
                            name="rt_id" id="rt-select">
                            @foreach ($all_rts as $rt)
                                <option value="{{ $rt->no_rt }}" {{ $rt->id == $selectedRtId ? 'selected' : '' }}>
                                    RT {{ $rt->no_rt }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full md:flex-1">
                        <label for="tahun-select" class="font-semibold text-lg text-gray-700">Pilih Tahun:</label>
                        <select
                            class="select w-full mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#328E6E] focus:border-[#328E6E] transition-all"
                            name="tahun" id="tahun-select">
                            @forelse ($list_tahun as $tahun)
                                <option value="{{ $tahun }}" {{ $tahun == $selectedTahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @empty
                                <option value="">Data tahun tidak tersedia</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="w-full md:w-auto mt-7 md:mt-0">
                        <button
                            class="w-full bg-[#44BB91] text-white font-bold rounded-lg px-6 py-3 transition-all duration-300 ease-in-out hover:scale-105 hover:bg-[#328E6E] hover:shadow-md active:scale-100 transform-gpu will-change-transform disabled:bg-gray-400 disabled:cursor-not-allowed disabled:hover:scale-100"
                            type="submit" id="button-filter">Tampilkan</button>
                    </div>
                </form>

                {{-- Volume Sampah Section --}}
                <div class="flex flex-col items-center pb-12">
                    <h1 class="text-center text-3xl md:text-[2.5rem] font-bold mb-1 text-black/75" id="volume-sampah"
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
