@extends('layouts.sidebar')

@section('title', 'Laporan Keuangan')

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <div class="bg-linear-to-br from-rose-400 to-red-600 p-2 rounded-lg shadow-lg shadow-red-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-graph-down-arrow" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 11.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-1 0v2.6l-3.613-4.417a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61L13.445 11H10.5a.5.5 0 0 0-.5.5Z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Pengeluaran & Transparansi</h2>
                <p class="text-sm text-gray-500">Laporan arus kas RT.</p>
            </div>
        </div>

        <button onclick="modal_pengeluaran.showModal()" class="btn bg-red-600/80 hover:bg-red-700/80 text-white border-none shadow-md gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
            </svg>
            Catat Pengeluaran
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Saldo Akhir (Penting!) -->
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-[#016B61]">
            <p class="text-gray-500 text-sm font-medium uppercase">Saldo Kas RT</p>
            <h3 class="text-3xl font-extrabold text-[#016B61] mt-1">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</h3>
            <p class="text-xs text-gray-400 mt-2">Total Kas</p>
        </div>

        <!-- Pengeluaran Bulan Ini -->
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-500">
            <p class="text-gray-500 text-sm font-medium uppercase">Pengeluaran Bulan Ini</p>
            <h3 class="text-3xl font-extrabold text-red-500 mt-1">Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</h3>
            <p class="text-xs text-gray-400 mt-2">Periode {{ now()->translatedFormat('F Y') }}</p>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8">
        <h3 class="font-bold text-gray-800 mb-4">Arus Kas 6 Bulan Terakhir</h3>
        <div class="relative h-72 w-full">
            <canvas id="financeChart"></canvas>
        </div>
    </div>

    <!-- Tabel Riwayat -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="font-bold text-gray-800">Riwayat Pengeluaran</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th>Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengeluarans as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
                        <td>
                            <div class="font-bold text-gray-800">{{ $item->judul }}</div>
                            <div class="text-xs text-gray-400 max-w-md truncate">{{ $item->deskripsi }}</div>
                        </td>
                        <td class="font-mono font-bold text-red-500">- Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td>
                            @if($item->bukti_foto_url)
                                <a href="{{ asset($item->bukti_foto_url) }}" target="_blank" class="btn btn-xs btn-ghost text-blue-500">Lihat Nota</a>
                            @else
                                <span class="text-xs text-gray-300">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-8 text-gray-400">Belum ada data pengeluaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $pengeluarans->links() }}
        </div>
    </div>

    {{-- MODAL INPUT PENGELUARAN --}}
    <dialog id="modal_pengeluaran" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg mb-4 text-red-600">Catat Pengeluaran Baru</h3>

            <form action="{{ route('rt.pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-control w-full mb-4">
                    <label class="label"><span class="label-text">Judul Pengeluaran</span></label>
                    <input type="text" name="judul" class="input input-bordered w-full" placeholder="Contoh: Donasi DLH" required />
                </div>

                <div class="form-control w-full mb-4">
                    <label class="label"><span class="label-text">Tanggal</span></label>
                    <input type="date" name="tanggal" class="input input-bordered w-full" value="{{ date('Y-m-d') }}" required />
                </div>

                <div class="form-control w-full mb-4">
                    <label class="label"><span class="label-text">Nominal (Rp)</span></label>
                    <input type="number" name="jumlah" class="input input-bordered w-full" placeholder="0" min="0" required />
                </div>

                <div class="form-control w-full mb-4">
                    <label class="label"><span class="label-text">Deskripsi (Opsional)</span></label>
                    <textarea name="deskripsi" class="textarea textarea-bordered h-20 w-full" placeholder="Detail pengeluaran..."></textarea>
                </div>

                <div class="form-control w-full mb-6">
                    <label class="label"><span class="label-text">Upload Nota/Bukti (Opsional)</span></label>
                    <input type="file" name="bukti_foto" class="file-input file-input-bordered w-full" accept="image/*" />
                </div>

                <button type="submit" class="btn bg-red-600/80 hover:bg-red-700/80 text-white w-full border-none">Simpan Pengeluaran</button>
            </form>
        </div>
    </dialog>

    {{-- Script Chart JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('financeChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartData['labels']),
                datasets: [
                    {
                        label: 'Pemasukan (Iuran)',
                        data: @json($chartData['pemasukan']),
                        backgroundColor: '#10b981',
                        borderRadius: 4,
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($chartData['pengeluaran']),
                        backgroundColor: '#ef4444',
                        borderRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // SweetAlert Success
        </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            confirmButtonColor: '#016B61'
        });
    </script>
    @endif
@endsection
