@extends('layouts.index')
@section('title', 'Tentang')
@section('content')

    {{-- header --}}

    {{-- awal --}}
    <div class="h-screen bg-cover bg-center" style="background-image: url({{ asset('assets/begron.svg') }})">
        {{-- Kontainer untuk Teks --}}
        <div class="container mx-auto px-6 lg:px-8 pt-10 pb-20 lg:pt-12 lg:pb-24 relative z-20" data-animasi="zoom-in"
            data-delay="100">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4 pt-24" data-animasi="">
                <span
                    class="inline-block text-[#066057] [text-shadow:0px_1.5px_2px_rgba(0,0,0,0.4)]
                transform transition-transform duration-300 hover:scale-110 hover:-translate-y-1 cursor-pointer">
                    Tentang
                </span>
                <span
                    class="inline-block text-[#529661] [text-shadow:0px_1.5px_2px_rgba(0,0,0,0.4)]
                transform transition-transform duration-300 hover:scale-105 hover:-translate-y-1 cursor-pointer">
                    KenalBersih
                </span>
            </h1>
            <p class="text-base text-[#201E43] max-w-2xl mb-8 mt-8">KenalBersih merupakan website yang dirancang
                khusus untuk membantu Ketua RT yang ada di Desa Mendalo Indah,
                Kabupaten Muaro Jambi mengelola sampah di lingkungan RT mereka dengan baik. Melalui website ini, warga dapat
                melihat jadwal pengangkutan sampah setiap minggunya, membuat laporan apabila mendapati sampah yang menumpuk
                di suatu
                tempat, hingga
                membayar iuran kebersihan setiap bulannya. Lingkungan yang bersih membuat kita nyaman beraktifitas dan
                terhindar dari
                berbagai macam penyakit. Segera daftarkan RT Anda di website ini agar pengelolaan sampah di lingkungan Anda
                dapat terorganisir dengan baik!
            </p>

            <div class="">
                <a href="https://sid.mendaloindah.desa.id/" target="_blank" rel="noopener noreferrer"
                    class="btn btn-lg bg-(--bg-tertiary) text-[#F5FFFA] rounded-3xl hover:bg-(--bg-secondary)
                 hover:shadow-md hover:scale-103 will-change-transform transform-gpu transition-all duration-300
                 ease-in-out active:scale-100 active:shadow-none mr-5">Profil
                    Desa</a>

                <a href="#selengkapnya"
                    class="btn btn-lg bg-(--bg-tertiary) text-[#F5FFFA] rounded-3xl hover:bg-(--bg-secondary)
                 hover:shadow-md hover:scale-103 will-change-transform transform-gpu transition-all duration-300
                 ease-in-out active:scale-100 active:shadow-none">Selengkapnya</a>
            </div>

            {{-- <img src="/assets/bukit.svg" alt=""
                class="w-[2000px] mx-auto z-0 left-0 right-0 top-[100px]"> --}}
        </div>
    </div>

    {{-- bagian tengah --}}
    <div id="selengkapnya" class="bg-[#F1FCFF] pt-12">
        <div class="bg-[#F1FCFF] h-fit py-10 relative">
            <h1 class="text-5xl font-extrabold text-center text-[#066057]">
                Daftar Layanan KenalBersih
            </h1>
            <ul class="timeline timeline-snap-icon max-md:timeline-compact timeline-vertical pt-8">
                <li>
                    <div class="timeline-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">

                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                clip-rule="evenodd" />

                        </svg>
                    </div>
                    <div class="timeline-start pl-2 mb-10 md:text-end pr-2 md:w-5/6">
                        <time class="text-[#529661] text-lg font-black">Laporan Volume Sampah</time>
                        <div class=""></div>
                        <p class="">
                            Ibarat buku harian sampah kita bersama, Pengurus RT dapat mengisi
                            data sampah yang berhasil
                            dikumpulkan.
                            Kemudian, semua warga bisa melihat datanya dengan mudah. Kita bisa
                            tahu berapa banyak sampah
                            yang terkumpul bulan ini, tahun ini, hingga jenis sampahnya mulai
                            dari organik, anorganik, dan
                            B3. Jadi, kita
                            bisa tahu apakah usaha daur ulang kita sudah berhasil atau belum.
                            Semua jadi terbuka dan jelas!
                        </p>
                    </div>
                    <div class="timeline-end hidden md:block pl-2 md:w-5/6">
                        <div class="h-full flex items-center justify-start">
                            <div class="p-4">
                                <img src="/img/sampah.png" alt="" class="w-70">
                            </div>
                        </div>
                    </div>
                    <hr />

                </li>
                <li>

                    <hr />
                    <div class="timeline-start hidden md:block pr-2 md:w-5/6">
                        <div class="h-full flex items-center justify-end">
                            <div class="p-4">
                                <img src="/img/kalender.png" alt="" class="w-45">
                            </div>
                        </div>
                    </div>
                    <div class="timeline-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">

                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                clip-rule="evenodd" />

                        </svg>
                    </div>
                    <div class="timeline-end pl-2 mb-10 pr-2 md:w-5/6">
                        <time class="text-[#529661] text-lg font-black">Jadwal Pengangkutan
                            Sampah</time>
                        <div class=""></div>
                        Jangan bingung lagi kapan truk sampah datang! Ini adalah papan informasi
                        jadwal yang dipegang oleh
                        RT. Pengurus RT bisa memasukkan dan mengubah jadwal angkut sampah di sini.
                        Warga bisa mengecek
                        jadwalnya kapan saja. Begitu ada perubahan atau sampah sudah diangkut,
                        statusnya akan langsung
                        diperbarui. Lingkungan pun jadi bersih tepat waktu.
                    </div>

                    <hr />

                </li>
                <li>

                    <hr />
                    <div class="timeline-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">

                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                clip-rule="evenodd" />

                        </svg>
                    </div>
                    <div class="timeline-start pl-2 mb-10 md:text-end pr-2 md:w-5/6">
                        <time class="text-[#529661] text-lg font-black">Pembayaran Iuran
                            Kebersihan</time>
                        <div class=""></div>
                        Bayar iuran bulanan jadi super gampang, secepat kirim pesan! Warga bisa
                        membayar iuran kebersihan
                        langsung lewat website ini, biasanya bisa pakai transfer atau cara digital
                        lainnya. Kita tidak perlu
                        repot lagi menanti petugas tagihan. Pembayaran akan langsung tercatat
                        otomatis, kita pun langsung
                        dapat buktinya. Proses kebersihan RT jadi lancar karena dananya selalu siap.
                    </div>
                    <div class="timeline-end hidden md:block pl-2 md:w-5/6">
                        <div class="h-full flex items-center justify-start">
                            <div class="p-4">
                                <img src="/img/duit.png" alt="" class="w-45">
                            </div>
                        </div>
                    </div>
                    <hr />

                </li>
                <li>

                    <hr />
                    <div class="timeline-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">

                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                clip-rule="evenodd" />

                        </svg>
                    </div>
                    <div class="timeline-end pl-2 md:mb-10 pr-2 md:w-5/6">
                        <time class="text-[#529661] text-lg font-black">Melaporkan Sampah
                            Menumpuk</time>
                        <div class=""></div>
                        Kalau Bapak/Ibu atau Adik-adik melihat ada tumpukan sampah yang tercecer
                        atau belum diangkut,
                        langsung saja laporkan di sini! Cukup foto, kasih keterangan tempatnya, dan
                        kirim. Laporan ini akan
                        segera diterima oleh RT. Pengurus RT akan langsung bertindak cepat untuk
                        menangani tumpukan
                        tersebut. Kita semua bisa ikut menjaga kebersihan lingkungan dengan mudah
                        dan cepat.
                    </div>

                    <div class="timeline-start hidden md:block pr-2 md:w-5/6">
                        <div class="h-full flex items-center justify-end">
                            <div class="p-4">
                                <img src="/img/orang.png" alt="" class="w-50">
                            </div>
                        </div>
                    </div>
                    <hr />
                </li>
            </ul>
        </div>
    </div>



    @vite(['resources/js/utility/navbar_lapor_sampah.js'])
@endsection
