@extends('layouts.sidebar')
@section('title', 'Dashboard RT')

@section('content')
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-3">
            <div
                class="bg-linear-to-br from-(--bg-tertiary) to-(--bg-secondary) p-2 rounded-lg shadow-lg shadow-green-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-house-door-fill"
                    viewBox="0 0 16 16">
                    <path
                        d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
            </div>
        </div>

        <!-- Form Filter Tahun & Bulan -->
        <form action="{{ route('dashboard') }}" method="GET"
            class="flex flex-wrap items-center gap-3 bg-white p-2 px-4 rounded-xl shadow-sm border border-gray-100">

            <!-- Filter Bulan -->
            <div class="form-control w-full md:w-auto">
                <select name="bulan"
                    class="select select-bordered select-sm w-full md:w-32 focus:border-purple-500 focus:ring-purple-500">
                    @foreach(range(1, 12) as $bulan)
                        <option value="{{ $bulan }}" {{ $bulan == $selectedBulan ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Tahun -->
            <div class="form-control w-full md:w-auto">
                <select name="tahun"
                    class="select select-bordered select-sm w-full md:w-28 focus:border-purple-500 focus:ring-purple-500">
                    @forelse($listTahun as $tahun)
                        <option value="{{ $tahun }}" {{ $tahun == $selectedTahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @empty
                        <option value="{{ now()->year }}">{{ now()->year }}</option>
                    @endforelse
                </select>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-sm bg-(--bg-secondary) hover:bg-(--bg-primary) text-white border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter
            </button>
        </form>
    </div>

    <details class="collapse collapse-arrow bg-white shadow-md border border-gray-100 rounded-xl mb-8">
        <summary class="collapse-title text-lg font-bold text-[#016B61] bg-[#E1EEBC]/60">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block align-middle" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Input Data Volume Sampah Bulanan
        </summary>
        <div class="collapse-content bg-white p-6 pt-0">
            <form action="{{ route('rt.volume.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <p class="text-md text-gray-500 mb-2 font-medium mt-3">Masukkan data volume sampah (dalam Kilogram) untuk periode tertentu.
                </p>

                {{-- Pilihan Bulan & Tahun (Sama seperti Filter) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-control flex flex-col">
                        <label class="label"><span class="label-text">Bulan</span></label>
                        <select name="bulan" class="select select-bordered focus:border-[#016B61]">
                            @foreach(range(1, 12) as $bulan)
                                <option value="{{ $bulan }}" {{ $bulan == now()->month ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control flex flex-col">
                        <label class="label"><span class="label-text">Tahun</span></label>
                        <select name="tahun" class="select select-bordered focus:border-[#016B61]">
                            @php $currentYear = now()->year; @endphp
                            @for ($y = $currentYear; $y >= $currentYear - 3; $y--)
                                <option value="{{ $y }}" {{ $y == $currentYear ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                {{-- Input Volume Sampah --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-control flex flex-col">
                        <label class="label"><span class="label-text">Organik (Kg)</span></label>
                        <input type="number" name="organik" step="0.01" min="0"
                            class="input input-bordered focus:border-rose-500" placeholder="0.00" required>
                    </div>
                    <div class="form-control flex flex-col">
                        <label class="label"><span class="label-text">Non-Organik (Kg)</span></label>
                        <input type="number" name="non_organik" step="0.01" min="0"
                            class="input input-bordered focus:border-blue-500" placeholder="0.00" required>
                    </div>
                    <div class="form-control flex flex-col">
                        <label class="label"><span class="label-text">B3 (Kg)</span></label>
                        <input type="number" name="b3" step="0.01" min="0"
                            class="input input-bordered focus:border-emerald-500" placeholder="0.00" required>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn bg-[#016B61] hover:bg-[#328E6E] text-white w-full md:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                clip-rule="evenodd" />
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </details>

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Card 1: Sampah Organik -->
        <div
            class="relative overflow-hidden bg-linear-to-r from-rose-400 to-red-500 rounded-xl p-6 text-white shadow-lg shadow-red-500/30 transition-transform hover:-translate-y-1">
            <!-- Circle Decoration -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 right-0 w-24 h-24 bg-white/10 rounded-full -mb-8 -mr-8"></div>

            <div class="relative z-10">
                <h3 class="font-semibold text-lg mb-1">Sampah Organik</h3>
                <div class="flex items-end gap-2 mb-2">
                    <span class="text-3xl font-bold">{{ $organik }} KG</span>
                </div>
                <p class="text-rose-100 text-sm">{{ $bulanInfo }}</p>
            </div>
            <div class="absolute top-6 right-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white/80" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
        </div>

        <!-- Card 2: Sampah Non-Organik (Blue Gradient) -->
        <div
            class="relative overflow-hidden bg-linear-to-r from-blue-400 to-cyan-500 rounded-xl p-6 text-white shadow-lg shadow-blue-500/30 transition-transform hover:-translate-y-1">
            <!-- Circle Decoration -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 right-0 w-24 h-24 bg-white/10 rounded-full -mb-8 -mr-8"></div>

            <div class="relative z-10">
                <h3 class="font-semibold text-lg mb-1">Non-Organik</h3>
                <div class="flex items-end gap-2 mb-2">
                    <span class="text-3xl font-bold">{{ $nonOrganik }} KG</span>
                </div>
                <p class="text-blue-100 text-sm">{{ $bulanInfo }}</p>
            </div>
            <div class="absolute top-6 right-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white/80" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
        </div>

        <!-- Card 3: Sampah B3 (Green Gradient) -->
        <div
            class="relative overflow-hidden bg-linear-to-r from-emerald-400 to-teal-500 rounded-xl p-6 text-white shadow-lg shadow-emerald-500/30 transition-transform hover:-translate-y-1">
            <!-- Circle Decoration -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 right-0 w-24 h-24 bg-white/10 rounded-full -mb-8 -mr-8"></div>

            <div class="relative z-10">
                <h3 class="font-semibold text-lg mb-1">Sampah B3</h3>
                <div class="flex items-end gap-2 mb-2">
                    <span class="text-3xl font-bold">{{ $b3 }} KG</span>
                </div>
                <p class="text-emerald-100 text-sm">{{ $bulanInfo }}</p>
            </div>
            <div class="absolute top-6 right-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white/80" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Chart Section  -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Line Chart -->
        <div class="bg-white p-6 rounded-xl shadow-sm lg:col-span-2 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-800">Statistik Volume Sampah</h3>
                <div class="flex gap-2">
                    <span class="badge badge-xs bg-rose-100 text-rose-600 border-none p-2">Organik</span>
                    <span class="badge badge-xs bg-blue-100 text-blue-600 border-none p-2">Non-Organik</span>
                    <span class="badge badge-xs bg-emerald-100 text-emerald-600 border-none p-2">B3</span>
                </div>
            </div>
            <div class="relative h-64 w-full">
                <canvas id="line-chart" data-labels="{{ json_encode($chartData['labels']) }}"
                    data-organik="{{ json_encode($chartData['organik']) }}"
                    data-non-organik="{{ json_encode($chartData['non_organik']) }}"
                    data-b3="{{ json_encode($chartData['b3']) }}">
                </canvas>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Proporsi Sampah (Bulan Ini)</h3>
            <div class="relative h-64 flex justify-center">
                <canvas id="pie-chart" data-organik="{{ $organik }}" data-non-organik="{{ $nonOrganik }}"
                    data-b3="{{ $b3 }}">
                </canvas>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-10">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Kelola Jadwal Angkut</h3>
                <p class="bg-black/5 border-l-4 rounded border-(--bg-secondary) text-sm px-2 font-medium text-gray-500">Klik
                    tanggal untuk tambah, klik event untuk edit/hapus.</p>
            </div>
            <!-- Legend Kecil -->
            <div class="flex gap-2 text-xs">
                <div class="flex items-center gap-1">
                    <div class="w-3 h-3 rounded-full bg-emerald-500"></div> Diangkut
                </div>
                <div class="flex items-center gap-1">
                    <div class="w-3 h-3 rounded-full bg-gray-400"></div> Belum
                </div>
            </div>
        </div>
        <!-- FullCalendar Container -->
        <div id="calendar" class="min-h-[600px]"></div>
    </div>

    <dialog id="jadwal_modal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg mb-4" id="modal-title">Tambah Jadwal</h3>
            <form id="jadwal-form">
                <input type="hidden" id="input-jadwal-id">
                <!-- Input Tanggal -->
                <div class="form-control w-full mb-4">
                    <label class="label"><span class="label-text">Tanggal</span></label>
                    <input type="date" id="input-jadwal-date" name="jadwal" class="input input-bordered w-full" required />
                </div>
                <!-- Input Status -->
                <div class="form-control w-full mb-6">
                    <label class="label"><span class="label-text">Status Pengangkutan</span></label>
                    <select id="input-jadwal-status" name="status" class="select select-bordered w-full">
                        <option value="Belum Diangkut">Belum Diangkut</option>
                        <option value="Diangkut">Sudah Diangkut</option>
                    </select>
                </div>
                <!-- Action Buttons -->
                <div class="flex justify-end gap-2">
                    <button type="button" id="btn-delete" class="btn btn-error text-white hidden">Hapus</button>
                    <button type="submit" id="btn-save" class="btn btn-primary text-white">Simpan</button>
                </div>
            </form>
        </div>
    </dialog>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#10b981'
            });
        </script>
    @endif
    @vite(['resources/js/jadwal_admin.js'])
@endsection
