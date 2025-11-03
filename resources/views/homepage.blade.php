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
        {{-- Chart --}}
        <div class="h-[500vh] pt-18">
            <x-chart :all_rts="$all_rts" :selectedRtId="$selectedRtId" :selectedTahun="$selectedTahun" :dataBulanan="$dataBulanan"></x-chart>
        </div>

        <div class="divider px-20"></div>
    </div>
    @vite('resources/js/utility/navbar.js')
@endsection
