@extends('layouts.index')
@section('title', 'Iuran')

@section('content')
    <div class="bg-[#F1FCFF] min-h-screen pb-20">
        {{-- Header Dekoratif --}}
        <div
            class="bg-linear-to-br from-(--bg-secondary) to-(--bg-primary) pt-24 pb-32 rounded-b-[3rem] relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-10"
                style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>

            <div class="container mx-auto px-6 text-center relative z-10 text-white">
                <h1 class="text-3xl font-bold mb-2">Pembayaran Iuran Warga</h1>
                <p class="opacity-90">RT {{ $rt->no_rt }} - {{ $rt->alamat_rumah }}</p>
            </div>
        </div>

        <div class="container mx-auto px-6 -mt-20 relative z-20">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- KOLOM KIRI: FORM PEMBAYARAN --}}
                <div class="lg:col-span-1 space-y-6">

                    {{-- Kartu Tagihan (Bill Card) --}}
                    <div class="card bg-white shadow-xl border border-gray-100">
                        <div class="card-body p-6 text-center">
                            <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Tagihan
                                {{ $rt->jenis_iuran }}</p>
                            <h2 class="text-4xl font-extrabold text-[#016B61] my-2">
                                Rp {{ number_format($rt->biaya_iuran, 0, ',', '.') }}
                            </h2>
                            <div class="badge bg-yellow-100 text-yellow-700 border-none p-3 font-semibold">
                                Wajib Dibayar
                            </div>
                        </div>
                    </div>

                    {{-- Kartu Info Rekening (Payment Target) --}}
                    <div class="card bg-white shadow-xl border border-gray-100">
                        <div class="card-body p-6">
                            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-qr-code-scan text-[#016B61]" viewBox="0 0 16 16">
                                    <path
                                        d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-3Zm3.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z" />
                                    <path
                                        d="M1.625 0C.728 0 0 .728 0 1.625v3.75C0 6.272.728 7 1.625 7h3.75c.897 0 1.625-.728 1.625-1.625v-3.75C7 .728 6.272 0 5.375 0h-3.75Z" />
                                    <path d="M8.5 6.5a.5.5 0 0 1 .5.5v1.5a.5.5 0 0 1-1 0V7a.5.5 0 0 1 .5-.5Z" />
                                    <path
                                        d="M12.75 0c.414 0 .75.336.75.75v3.75c0 .414-.336.75-.75.75h-3.75a.75.75 0 0 1-.75-.75v-3.75C8.25.336 8.586 0 9 0h3.75ZM15 6.5a.5.5 0 0 1 .5.5V8a.5.5 0 0 1-1 0V7a.5.5 0 0 1 .5-.5Z" />
                                    <path
                                        d="M0 11.375C0 10.478.728 9.75 1.625 9.75h3.75c.897 0 1.625.728 1.625 1.625v3.75c0 .897-.728 1.625-1.625 1.625h-3.75C.728 16 0 15.272 0 14.375v-3.75Z" />
                                    <path d="M8.5 10.5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5Z" />
                                    <path d="M12.5 9a.5.5 0 0 1 .5.5v1.5a.5.5 0 0 1-1 0V9.5a.5.5 0 0 1 .5-.5Z" />
                                    <path d="M15.5 9.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 1 0v-3a.5.5 0 0 0-.5-.5Z" />
                                </svg>
                                Transfer Ke Sini
                            </h3>

                            <div
                                class="bg-gray-50 p-4 rounded-xl border border-gray-200 flex justify-between items-center group hover:border-[#016B61] transition-colors">
                                <div>
                                    <p class="text-xs text-gray-500">DANA / E-Wallet</p>
                                    <p class="text-lg font-bold text-gray-800" id="no-dana-text">{{ $rt->no_dana }}</p>
                                    <p class="text-xs text-gray-400 mt-1">a.n {{ $rt->nama }}</p>
                                </div>
                                <button onclick="copyToClipboard('{{ $rt->no_dana }}')"
                                    class="btn btn-square btn-sm btn-ghost text-[#016B61] tooltip" data-tip="Salin Nomor">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6ZM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1H2Z" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-xs text-gray-400 mt-2 italic">*Pastikan nominal transfer sesuai tagihan.</p>
                        </div>
                    </div>

                    {{-- Form Upload Bukti --}}
                    <div class="card bg-white shadow-xl border border-gray-100">
                        <div class="card-body p-6">
                            <h3 class="font-bold text-gray-800 mb-4">Konfirmasi Pembayaran</h3>

                            <form action="{{ route('iuran.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- Pilihan Periode --}}
                                <div class="form-control w-full mb-4">
                                    <label class="label"><span class="label-text font-semibold">Bayar Untuk
                                            Periode</span></label>
                                    <select name="periode" class="select select-bordered w-full focus:border-[#016B61]"
                                        required>
                                        @php $currentMonth = now()->translatedFormat('F Y'); @endphp
                                        <option value="" disabled selected>-- Pilih Periode --</option>

                                        {{-- Generate Opsi Berdasarkan Jenis Iuran RT --}}
                                        @if ($rt->jenis_iuran == 'Mingguan')
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $currentMonth }} - Minggu {{ $i }}">
                                                    {{ $currentMonth }} - Minggu {{ $i }}</option>
                                            @endfor
                                        @else
                                            <option value="{{ $currentMonth }}">{{ $currentMonth }}</option>
                                        @endif
                                    </select>
                                </div>

                                {{-- Upload Image --}}
                                <div class="form-control w-full mb-6">
                                    <label class="label"><span class="label-text font-semibold">Upload Bukti
                                            Transfer</span></label>

                                    <div class="relative w-full h-48 rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 flex flex-col justify-center items-center hover:bg-gray-100 transition-colors cursor-pointer"
                                        onclick="document.getElementById('bukti_input').click()">
                                        <input type="file" name="bukti_pembayaran" id="bukti_input" class="hidden"
                                            accept="image/*" onchange="previewImage(event)" required>

                                        <div id="preview-container" class="hidden w-full h-full p-2">
                                            <img id="preview-img" class="w-full h-full object-contain rounded-lg">
                                        </div>

                                        <div id="upload-placeholder" class="text-center p-4">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-10 w-10 mx-auto text-gray-400 mb-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-sm text-gray-500">Klik untuk upload gambar</p>
                                            <p class="text-xs text-gray-400">(JPG, PNG, Max 2MB)</p>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="btn bg-[#016B61] hover:bg-[#328E6E] text-white w-full border-none shadow-lg shadow-green-900/20">
                                    Kirim Bukti Pembayaran
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: RIWAYAT --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden min-h-[500px]">
                        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                            <h3 class="font-bold text-lg text-gray-800">Riwayat Pembayaran Anda</h3>
                            <span class="badge badge-ghost">{{ $riwayats->total() }} Transaksi</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <thead class="bg-white text-gray-500 text-xs font-bold uppercase">
                                    <tr>
                                        <th class="pl-6">ID Transaksi</th>
                                        <th>Periode</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100">
                                    @forelse($riwayats as $iuran)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="pl-6 font-mono text-xs text-gray-500">
                                                {{ $iuran->no_pembayaran }}
                                            </td>
                                            <td>
                                                <span class="font-medium text-gray-700">{{ $iuran->periode }}</span>
                                            </td>
                                            <td class="font-bold text-[#016B61]">
                                                Rp {{ number_format($iuran->jumlah_pembayaran, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                @php
                                                    $statusClass = match ($iuran->status_pembayaran) {
                                                        'Menunggu' => 'bg-yellow-100 text-yellow-700 border-none',
                                                        'Diterima' => 'bg-green-100 text-green-700 border-none',
                                                        'Ditolak' => 'bg-red-100 text-red-700 border-none',
                                                        default => 'bg-gray-100',
                                                    };
                                                    $statusIcon = match ($iuran->status_pembayaran) {
                                                        'Menunggu' => '⏳',
                                                        'Diterima' => '✅',
                                                        'Ditolak' => '❌',
                                                        default => '',
                                                    };
                                                @endphp
                                                <div class="badge {{ $statusClass }} gap-2 p-3 font-semibold">
                                                    {{ $statusIcon }} {{ $iuran->status_pembayaran }}
                                                </div>
                                            </td>
                                            <td class="text-gray-500 text-xs">
                                                {{ $iuran->created_at->translatedFormat('d M Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class=" py-12">
                                                <div class="flex flex-col gap-2 justify-center items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                                                        fill="currentColor" class="opacity-50 bi bi-file-earmark"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                                                    </svg>
                                                    <p class="text-gray-400">Belum ada riwayat pembayaran.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4">
                            {{ $riwayats->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @vite(['resources/js/utility/navbar_iuran.js'])
    {{-- Script: Copy Clipboard & Image Preview --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Disalin!',
                    text: 'Nomor DANA berhasil disalin ke clipboard.',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true,
                    position: 'top-end',
                    background: '#016B61',
                    color: '#fff',
                    iconColor: '#fff'
                });
            });
        }

        function previewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('preview-container');
            const previewImg = document.getElementById('preview-img');
            const placeholder = document.getElementById('upload-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#016B61'
            });
        @endif
    </script>
@endsection
