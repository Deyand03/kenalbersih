@extends('layouts.index')
@section('title', 'Tentang')
@section('content')

    {{-- header --}}
    <div class="bg-linear-to-br from-(--bg-secondary) to-(--bg-primary) h-16"></div>

    {{-- awal --}}
    <div class="bg-[#E0F9D3] relative min-h-[calc(100vh-4rem)] pb-20">
        {{-- Kontainer untuk Teks --}}
        <div class="container mx-auto px-6 lg:px-8 pt-10 pb-20 lg:pt-12 lg:pb-24 text-center relative z-20">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4">
                <span class="text-[#066057] [text-shadow:0px_1.5px_2px_rgba(0,0,0,0.4)]">
                    Tentang
                </span>
                <span class="text-[#529661] [text-shadow:0px_1.5px_2px_rgba(0,0,0,0.4)]">
                    KenalBersih
                </span>
            </h1>
            <p class="text-lg text-[#201E43] max-w-5xl mx-auto mb-8 mt-8">KenalBersih merupakan website yang dirancang khusus
                untuk membantu Ketua RT yang ada di Desa Mendalo Indah,
                Kabupaten Muaro Jambi mengelola sampah di lingkungan RT mereka dengan baik. Melalui website ini, warga dapat
                melihat jadwal
                pengangkutan sampah setiap minggunya, membuat laporan apabila mendapati sampah yang menumpuk di suatu
                tempat, hingga
                membayar iuran kebersihan setiap bulannya. Lingkungan yang bersih membuat kita nyaman beraktifitas dan
                terhindar dari
                berbagai macam penyakit. Segera daftarkan RT Anda di website ini agar pengelolaan sampah di lingkungan Anda
                dapat terorganisir dengan baik!</p>
        </div>

        {{-- Kontainer untuk Matahari dan Bukit --}}
        <div class="absolute bottom-0 left-0 w-full z-10 h-auto">
            {{-- Matahari --}}
            <img src="/assets/matahari.png" alt=""
                class="w-70 mx-auto animate-[spin_10s_linear_infinite] absolute z-0 left-0 right-0 top-100">

            {{-- Bukit --}}
            <img src="/assets/bukit.svg" class="w-full top-100 relative z-10" alt="">

            {{-- Mobil di atas bukit --}}
            <img src="/assets/mobil.png" alt="Mobil Sampah" class="absolute right-10 z-20 w-24 top-86 transform rotate-[-10deg]"
                style="bottom: 120px;">
        </div>
    </div>
@endsection
