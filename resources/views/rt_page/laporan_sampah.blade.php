@extends('layouts.sidebar')

@section('title', 'Laporan Sampah')

@section('content')
    <!-- Header -->
    <div class="flex items-center gap-3 mb-8">
        <div class="bg-linear-to-br from-(--bg-tertiary) to-(--bg-secondary) p-2 rounded-lg shadow-lg shadow-green-500/30">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Laporan Warga</h2>
            <p class="text-sm text-gray-500">Kelola laporan sampah dan update status penanganan.</p>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead class="bg-gray-50 text-gray-600 font-semibold uppercase text-xs">
                    <tr>
                        <th class="py-4">Pelapor</th>
                        <th>Lokasi & Tanggal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @forelse($laporans as $laporan)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <!-- Kolom Pelapor -->
                            <td class="py-3">
                                <div class="flex items-center gap-3">
                                    <div class="avatar placeholder">
                                        <div class="bg-purple-100 text-purple-600 rounded-full w-10 h-10 flex items-center justify-center font-bold">
                                            {{ substr($laporan->warga->nama ?? 'W', 0, 1) }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800">{{ $laporan->warga->nama ?? 'Warga' }}</div>
                                        <div class="text-xs text-gray-400">ID: {{ $laporan->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Kolom Lokasi -->
                            <td>
                                <div class="font-medium text-gray-700">{{ Str::limit($laporan->alamat, 30) }}</div>
                                <div class="text-xs text-gray-400 mt-1">
                                    {{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d M Y, H:i') }}
                                </div>
                            </td>

                            <!-- Kolom Status -->
                            <td>
                                @php
                                    $statusColor = match($laporan->status) {
                                        'Diajukan' => 'badge-warning text-yellow-700 bg-yellow-100 border-none',
                                        'Diterima' => 'badge-info text-blue-700 bg-blue-100 border-none',
                                        'Selesai' => 'badge-success text-emerald-700 bg-emerald-100 border-none',
                                        default => 'badge-ghost'
                                    };
                                @endphp
                                <div class="badge {{ $statusColor }} font-medium p-3">
                                    {{ $laporan->status }}
                                </div>
                            </td>

                            <!-- Kolom Aksi -->
                            <td class="text-center">
                                <button onclick="openModal('{{ $laporan->id }}', '{{ $laporan->warga->nama }}', '{{ $laporan->deskripsi }}', '{{ $laporan->alamat }}', '{{ $laporan->status }}', '{{ asset($laporan->foto_bukti_url) }}')"
                                    class="btn btn-sm btn-ghost text-purple-600 hover:bg-purple-50 tooltip" data-tip="Lihat Detail">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-10">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    <p>Belum ada laporan masuk.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4">
            {{ $laporans->links() }}
        </div>
    </div>

    {{-- MODAL DETAIL & UPDATE --}}
    <dialog id="modal_laporan" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box sm:w-11/12 sm:max-w-2xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>

            <h3 class="font-bold text-xl text-gray-800 mb-6 border-b pb-2">Detail Laporan</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Sisi Kiri: Foto Bukti -->
                <div>
                    <p class="text-sm font-semibold text-gray-500 mb-2">Foto Bukti:</p>
                    <div class="rounded-xl overflow-hidden border border-gray-200 bg-gray-50 h-64 flex items-center justify-center relative group">
                        <img id="modal-foto" src="" alt="Bukti Laporan" class="w-full h-full object-cover">
                        <div id="modal-no-foto" class="hidden text-gray-400 text-sm">Tidak ada foto</div>

                        <!-- Overlay Zoom Icon -->
                        <a id="modal-foto-link" href="#" target="_blank" class="absolute inset-0 bg-black/40 hidden group-hover:flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                        </a>
                    </div>
                </div>

                <!-- Sisi Kanan: Info & Form -->
                <div class="flex flex-col gap-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-500">Pelapor:</p>
                        <p id="modal-nama" class="text-gray-800 font-medium">-</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500">Alamat Lokasi:</p>
                        <p id="modal-alamat" class="text-gray-800 text-sm leading-relaxed">-</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500">Deskripsi Masalah:</p>
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100 text-gray-700 text-sm mt-1 h-24 overflow-y-auto" id="modal-deskripsi">
                            -
                        </div>
                    </div>

                    <!-- Form Update Status -->
                    <div class="mt-auto pt-4 border-t">
                        <form id="form-update-status">
                            <input type="hidden" id="modal-id-laporan">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text font-semibold">Update Status Penanganan:</span>
                                </div>
                                <div class="flex gap-2">
                                    <select id="modal-select-status" class="select select-bordered select-sm w-full focus:border-purple-500 focus:ring-purple-500">
                                        <option value="Diajukan">Diajukan</option>
                                        <option value="Diterima">Diterima (Sedang Proses)</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary text-white">Simpan</button>
                                </div>
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </dialog>

    <!-- Script Handling -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Fungsi buka modal & isi datanya
        function openModal(id, nama, deskripsi, alamat, status, fotoUrl) {
            document.getElementById('modal-id-laporan').value = id;
            document.getElementById('modal-nama').textContent = nama;
            document.getElementById('modal-deskripsi').textContent = deskripsi;
            document.getElementById('modal-alamat').textContent = alamat;
            document.getElementById('modal-select-status').value = status;

            const imgEl = document.getElementById('modal-foto');
            const linkEl = document.getElementById('modal-foto-link');
            const noFotoEl = document.getElementById('modal-no-foto');

            // Handle Foto (cegah broken image kalau null)
            if (fotoUrl && !fotoUrl.includes('storage//')) { // Basic validation check
                imgEl.src = fotoUrl;
                imgEl.classList.remove('hidden');
                linkEl.classList.remove('hidden');
                linkEl.href = fotoUrl;
                noFotoEl.classList.add('hidden');
            } else {
                imgEl.classList.add('hidden');
                linkEl.classList.add('hidden');
                noFotoEl.classList.remove('hidden');
            }

            document.getElementById('modal_laporan').showModal();
        }

        document.getElementById('form-update-status').addEventListener('submit', function(e) {
            e.preventDefault();

            const id = document.getElementById('modal-id-laporan').value;
            const status = document.getElementById('modal-select-status').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            Swal.fire({
                title: 'Menyimpan...',
                didOpen: () => Swal.showLoading()
            });

            fetch(`/rt/laporan-sampah/update/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    throw new Error(data.message || 'Gagal update status');
                }
            })
            .catch(error => {
                Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                console.error(error);
            });
        });
    </script>
@endsection
