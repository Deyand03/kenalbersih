@extends('layouts.index')
@section('title', 'Laporan Sampah')
@section('content')

    {{-- Bagian 1 --}}
    <div class="bg-linear-to-br from-(--bg-secondary) to-(--bg-primary) h-16"></div>

    <div class="bg-base-200 h-[65vh] relative overflow-hidden">
        {{-- Elemen dekoratif di latar belakang --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-5"
            style="background-image: radial-gradient(#187dab 1px, transparent 1px); background-size: 16px 16px;"></div>
        <div class="absolute -bottom-32 -left-20 w-80 h-80 border-8 border-[#F5C219] rounded-full opacity-20"></div>
        <div class="absolute -top-24 -right-20 w-80 h-80 border-8 border-[#187DAB] rounded-full opacity-20"></div>

        <div class="container mx-auto px-6 lg:px-8 py-20 lg:py-24 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">Laporan Sampah Menumpuk</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-8">
                Sampah yang menumpuk bikin nggak nyaman? Yuk, segera laporkan kepada kami supaya dapat ditangani!
            </p>
            <div class="flex justify-center gap-4">
                <button onclick="my_modal_3.showModal()"
                    class="btn btn-lg bg-(--bg-tertiary) text-(--text-primary) rounded-3xl hover:bg-(--bg-secondary) 
            hover:shadow-md hover:scale-103 will-change-transform transform-gpu transition-all duration-300
            ease-in-out active:scale-100 active:shadow-none">
                    + Buat Laporan
                </button>
                <dialog id="my_modal_3" class="modal">
                    <div class="modal-box">
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>
                        <form action="" class="flex flex-col gap-4">
                            <h1 class="text-2xl font-bold">Silakan buat laporan Anda</h1>
                            <div class="flex flex-col gap-3">
                                <div class="flex flex-col">
                                    <label for="" class="text-start">Judul</label>
                                    <input type="text" class="input w-full" placeholder="Masukkan Judul Laporan Anda">
                                </div>

                                <div class="flex flex-col">
                                    <label for="" class="text-start">Lokasi Sampah</label>
                                    <input type="text" class="input w-full"
                                        placeholder="Masukkan Lokasi Ditemukannya Sampah Menumpuk">
                                </div>

                                <div class="flex flex-col">
                                    <label for="" class="text-start">Deskripsi</label>
                                    <textarea name="" id="" class="textarea w-full" placeholder="Masukkan Pesan"></textarea>
                                </div>

                                <div class="flex flex-col">
                                    <label for="" class="text-start">Foto Bukti</label>
                                    <input type="file" class="file-input w-full">
                                </div>
                            </div>
                            <button class="btn bg-(--bg-tertiary) text-(--text-primary) gap-3">Kirim</button>
                        </form>
                    </div>
                </dialog>
            </div>
        </div>
    </div>

    <div class="p-20">
        {{-- Laporan Terbaru --}}
        <div class="">
            {{-- Header --}}
            <div class="">
                <h2 class="text-3xl font-bold border-l-6 border-(--bg-primary) pl-4">Laporan Terbaru</h2>
            </div>
            {{-- Table Content --}}
            <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 my-10">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Detail</th>
                            <th>Lampiran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr>
                            <th>1</th>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        <!-- row 2 -->
                        <tr>
                            <th>2</th>
                            <td>Hart Hagerty</td>
                            <td>Desktop Support Technician</td>
                            <td>Purple</td>
                        </tr>
                        <!-- row 3 -->
                        <tr>
                            <th>3</th>
                            <td>Brice Swyre</td>
                            <td>Tax Accountant</td>
                            <td>Red</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Riwayat --}}
        <div>
            {{-- Header --}}
            <div>
                <h2 class="text-3xl font-bold border-l-6 border-(--bg-primary) pl-4">Riwayat Laporan</h2>
            </div>
            {{-- Table Content --}}
            <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 my-10">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Detail</th>
                            <th>Lampiran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr>
                            <th>1</th>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        <!-- row 2 -->
                        <tr>
                            <th>2</th>
                            <td>Hart Hagerty</td>
                            <td>Desktop Support Technician</td>
                            <td>Purple</td>
                        </tr>
                        <!-- row 3 -->
                        <tr>
                            <th>3</th>
                            <td>Brice Swyre</td>
                            <td>Tax Accountant</td>
                            <td>Red</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
