@extends('layouts.index')
@section('title', 'Homepage')

@section('content')
    <div class="max-w-100vw w-full">
        {{-- Hero Page --}}
        <div class="relative h-screen">
            <div class="absolute inset-0 bg-cover bg-center md:h-screen h-[calc(100vh)]"
                style="background-image: url({{ asset('svg/Subtract.svg') }})">
                <div class="pt-16">
                    <div class="flex flex-wrap pt-10 px-10 md:px-20">
                        <div class="text-white md:w-[50vw]">
                            <div class="flex flex-col">
                                <h1 class="text-5xl font-bold mb-16">Bukankah ini my...</h1>
                                <h2 class="text-3xl font-semibold text-[#E1EEBC]">Shorekeeper</h2>
                                <p class="font-semibold text-md md:text-lg">Shorekeeper in Wuthering Waves is a 5 Stars
                                    Spectro
                                    character who wields a Rectifier as
                                    their weapon type.
                                    The Shorekeeper, guardian of the Black Shores—this title alone once defined her.
                                    But
                                    desires, bonds, and emotions… She only began to understand these things after meeting
                                    you.
                                </p>
                            </div>
                        </div>
                        <div class="justify-center hidden md:flex">
                            <img src="{{ asset('img/shorekeeper.png') }}" alt="Shorekeeper" class="w-104 object-contain">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="h-fit pt-18">
            <div>
                <svg viewBox="0 0 1919 235" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.54785 0C4.81639 1.79796 3.75 4.24133 3.75 6.93457V45.2686C3.7501 47.8172 4.62521 50.1672 6.4043 51.9922C28.462 74.6169 183.328 228.213 295.826 200.062C379.298 179.175 452.204 161.914 531.5 123.949C738.6 24.7945 807.469 279.289 1026.02 228.038C1115.94 206.95 1178.99 136.44 1270 148.896C1320.89 155.861 1354.41 170.13 1404.62 182.425C1531.4 213.474 1660.34 2.48267 1742.5 123.949C1801.14 210.648 1887.68 202.642 1913.33 198.014C1915.72 197.583 1917.69 196.242 1919 194.394V235H0V0H6.54785ZM1919 1.2832C1918.69 0.826361 1918.34 0.397836 1917.95 0H1919V1.2832Z"
                        fill="#F1FCFF" />
                </svg>
            </div>
            <div class="bg-[#F1FCFF] h-fit pb-20 px-10 md:px-20">
                <x-chart :all_rts="$all_rts" :selectedRtId="$selectedRtId" :selectedTahun="$selectedTahun"
                    :dataBulanan="$dataBulanan"></x-chart>
                <x-jadwal></x-jadwal>
            </div>

        </div>

    </div>
    @vite('resources/js/utility/navbar_homepage.js')
@endsection
