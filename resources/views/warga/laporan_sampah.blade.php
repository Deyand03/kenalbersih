@extends('layouts.index')
@section('title', 'Laporan Sampah')
@section('content')

    {{-- Hero Section --}}
    <div class="relative bg-[#F1FCFF] overflow-hidden">
        {{-- Elemen Dekoratif --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-10"
            style="background-image: radial-gradient(#016B61 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div
            class="absolute -bottom-40 -left-20 w-96 h-96 bg-[#44BB91] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute top-0 -right-20 w-96 h-96 bg-[#016B61] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>

        <div class="container mx-auto px-6 lg:px-8 pt-32 pb-20 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-6 leading-tight">
                Laporan Sampah <span class="text-[#016B61]">Menumpuk</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-10">
                Lingkungan bersih dimulai dari kita. Laporkan tumpukan sampah di sekitar Anda agar segera ditangani oleh
                petugas RT.
            </p>

            <button onclick="my_modal_3.showModal()"
                class="btn btn-lg bg-[#016B61] text-white border-none rounded-full px-8 shadow-lg shadow-[#016B61]/30 hover:bg-[#328E6E] hover:scale-105 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Laporan Baru
            </button>
        </div>
    </div>

    {{-- Modal Form Laporan --}}
    <dialog id="my_modal_3" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box sm:max-w-lg">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>

            <h3 class="font-bold text-2xl text-[#016B61] mb-1">Buat Laporan</h3>
            <p class="text-sm text-gray-500 mb-6">Sertakan foto dan lokasi yang jelas ya!</p>

            <form action="{{ route('laporan_sampah.store') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col gap-4">
                @csrf

                <!-- Lokasi -->
                <div class="form-control w-full">
                    <label class="label"><span class="label-text font-semibold">Lokasi Sampah</span></label>
                    <input type="text" name="alamat"
                        class="input input-bordered w-full focus:border-[#016B61] focus:ring-1 focus:ring-[#016B61]"
                        placeholder="Contoh: Depan Pos Ronda RT 01" required>
                </div>

                <!-- Deskripsi -->
                <div class="form-control w-full">
                    <label class="label"><span class="label-text font-semibold">Deskripsi Masalah</span></label>
                    <textarea name="deskripsi"
                        class="textarea textarea-bordered w-full h-24 focus:border-[#016B61] focus:ring-1 focus:ring-[#016B61]"
                        placeholder="Jelaskan kondisi sampahnya..." required></textarea>
                </div>

                <!-- Foto Bukti -->
                <div class="form-control w-full">
                    <label class="label"><span class="label-text font-semibold">Foto Bukti</span></label>
                    <input type="file" name="foto_bukti" class="file-input file-input-bordered file-input-success w-full"
                        accept="image/*" required />
                    <label class="label"><span class="label-text-alt text-gray-400">Format: JPG, PNG (Max
                            2MB)</span></label>
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn bg-[#016B61] hover:bg-[#328E6E] text-white w-full border-none">Kirim
                        Laporan</button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- Section Riwayat Laporan --}}
    <div class="container mx-auto px-6 lg:px-20 py-12 mb-20">
        <div class="flex items-center gap-4 mb-8">
            <div class="bg-[#E1EEBC] p-3 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#016B61]" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Riwayat Laporan Anda</h2>
                <p class="text-gray-500 text-sm">Pantau status penanganan sampah yang Anda laporkan.</p>
            </div>
        </div>

        {{-- Card Table --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <!-- Head -->
                    <thead class="bg-[#F1FCFF] text-gray-600 font-bold uppercase text-xs">
                        <tr>
                            <th class="py-4 pl-6">Tanggal</th>
                            <th>Lokasi & Deskripsi</th>
                            <th>Bukti Foto</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($laporans as $laporan)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="pl-6 align-top py-4">
                                    <div class="font-semibold text-gray-700">
                                        {{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-400 mt-1">
                                        {{ \Carbon\Carbon::parse($laporan->created_at)->format('H:i') }} WIB
                                    </div>
                                </td>
                                <td class="align-top py-4">
                                    <div class="font-bold text-[#016B61] mb-1">{{ Str::limit($laporan->alamat, 30) }}</div>
                                    <p class="text-gray-500 text-xs leading-relaxed max-w-xs">
                                        {{ Str::limit($laporan->deskripsi, 60) }}
                                    </p>
                                </td>
                                <td class="align-top py-4">
                                    <div class="avatar">
                                        <div class="w-16 h-16 rounded-xl ring-1 ring-gray-200">
                                            <a href="{{ asset('storage/' . $laporan->foto_bukti) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" alt="Bukti"
                                                    class="object-cover" />
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-top py-4">
                                    @php
                                        $statusClass = match ($laporan->status) {
                                            'Diajukan' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                            'Diterima' => 'bg-blue-100 text-blue-700 border-blue-200',
                                            'Selesai' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                            default => 'bg-gray-100 text-gray-700'
                                        };
                                        $statusIcon = match ($laporan->status) {
                                            'Diajukan' => '⏳',
                                            'Diterima' => '🛠️',
                                            'Selesai' => '✅',
                                            default => '❓'
                                        };
                                    @endphp
                                    <div class="badge {{ $statusClass }} gap-2 p-3 font-semibold border">
                                        <span>{{ $statusIcon }}</span>
                                        {{ $laporan->status }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-12">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <img src="https://illustrations.popsy.co/amber/surr-list-is-empty.svg" alt="Empty"
                                            class="h-32 mb-4 opacity-50">
                                        <p class="font-medium">Belum ada laporan yang Anda buat.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($laporans->hasPages())
                <div class="p-4 border-t border-gray-100 bg-gray-50">
                    {{ $laporans->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- SweetAlert2 untuk Notifikasi Sukses --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#016B61'
            });
        </script>
    @endif
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#016B61'
            });
        </script>
    @endif

    {{-- Lyra's Add: Handle Error (Penting buat kasus Warga null) --}}
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                confirmButtonColor: '#ef4444'
            });
        </script>
    @endif
    @vite('resources/js/utility/navbar_lapor_sampah.js')
@endsection
