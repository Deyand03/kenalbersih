@extends('layouts.index')
@section('title', 'Homepage')

@section('content')
    <div class="container">
        {{-- Hero Page --}}
        <div class="relative h-screen">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url({{ asset('img/Subtract.svg') }})">
                <div class="pt-[64px]">
                    <div class="flex flex-wrap pt-10 px-20">
                        <div class="text-white w-1/2">
                            <div class="flex flex-col">
                                <h1 class="text-5xl font-bold mb-16">Bukankah ini my...</h1>
                                <h2 class="text-3xl font-semibold text-[#E1EEBC]">Shorekeeper</h2>
                                <p class="font-semibold text-lg">Shorekeeper in Wuthering Waves is a 5 Stars Spectro character who wields a Rectifier as
                                    their weapon type. <br>
                                    The Shorekeeper, guardian of the Black Shores—this title alone once defined her. <br> But
                                    desires, bonds, and emotions… She only began to understand these things after meeting
                                    you.</p>
                            </div>
                        </div>
                        <div class="w-1/2 flex justify-center">
                            <img src="{{ asset('img/shorekeeper.png') }}" alt="Shorekeeper" class="w-[26rem] object-contain">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="divider px-20 pt-24 pb-16"></div>
        {{-- Chart --}}
        <div class="h-[500vh] px-14">
            <h1 class="text-4xl font-bold">[Chart Page]</h1>
        </div>

        <div class="divider px-20"></div>
    </div>
    @vite('resources/js/utility/navbar.js')
@endsection
