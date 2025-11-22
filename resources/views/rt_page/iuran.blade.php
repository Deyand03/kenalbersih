@extends('layouts.sidebar')
@section('title', 'Kelola Iuran')

@section('content')
    <!-- Header & Stats -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <div class="bg-linear-to-br from-[#44BB91] to-[#016B61] p-2 rounded-lg shadow-lg shadow-green-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-wallet2"
                    viewBox="0 0 16 16">
                    <path
                        d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Iuran Warga</h2>
                <p class="text-sm text-gray-500">Kelola pembayaran iuran bulanan.</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            {{-- Tombol Settings --}}
            <button onclick="modal_settings.showModal()"
                class="btn btn-outline border-[#016B61] text-[#016B61] hover:bg-[#016B61] hover:text-white gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path
                        d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                </svg>
                Atur Tarif
            </button>

            <!-- Tombol Input Manual -->
            <button onclick="modal_input_manual.showModal()"
                class="btn bg-(--bg-secondary) hover:bg-(--bg-primary) text-white border-none shadow-md gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2z" />
                </svg>
                Catat Tunai (Cash)
            </button>
        </div>
    </div>

    {{-- Bar Info --}}
    <div class="alert bg-white border border-gray-200 shadow-sm mb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            class="stroke-[#016B61] shrink-0 w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div>
            <h3 class="font-bold text-gray-700">Aturan Iuran Aktif</h3>
            <div class="text-xs text-gray-500">
                Warga dikenakan biaya <span class="font-bold text-[#016B61]">Rp
                    {{ number_format($rt->biaya_iuran, 0, ',', '.') }}</span> setiap
                <span class="badge badge-sm badge-ghost font-bold">{{ $rt->jenis_iuran }}</span>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Pemasukan Bulan Ini</p>
                <h3 class="text-3xl font-bold text-[#016B61]">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
            </div>
            <div class="p-3 bg-green-50 rounded-full text-[#016B61]">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-cash"
                    viewBox="0 0 16 16">
                    <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                    <path
                        d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
                </svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Menunggu Konfirmasi</p>
                <h3 class="text-3xl font-bold text-warning">{{ $menungguKonfirmasi }} <span
                        class="text-lg font-normal text-gray-400">Transaksi</span></h3>
            </div>
            <div class="p-3 bg-amber-50 rounded-full text-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <div role="tablist" class="tabs tabs-boxed bg-transparent p-0 mb-4 gap-2">
        <input type="radio" name="my_tabs_1" role="tab"
            class="tab h-10 px-6 rounded-full bg-white data-checked:bg-[#016B61] data-checked:text-white shadow-sm"
            aria-label="Menunggu Konfirmasi" checked />
        <div role="tabpanel" class="tab-content bg-white border border-gray-100 rounded-2xl p-6 mt-4 shadow-sm">
            <!-- Tabel Menunggu -->
            @if ($pendingIurans->isEmpty())
                <div class="text-center py-10 text-gray-400">
                    <p>Tidak ada pembayaran digital yang perlu dikonfirmasi.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th>Warga</th>
                                <th>Periode</th>
                                <th>Jumlah</th>
                                <th>Metode</th>
                                <th>Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingIurans as $iuran)
                                <tr class="hover:bg-gray-50">
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar placeholder">
                                                <div class="bg-neutral text-neutral-content rounded-full w-8">
                                                    <span class="text-xs">{{ substr($iuran->warga->nama, 0, 1) }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">{{ $iuran->warga->nama }}</div>
                                                <div class="text-xs text-gray-500">{{ $iuran->no_pembayaran }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- Tampilkan Periode --}}
                                    <td><span class="badge badge-ghost">{{ $iuran->periode ?? '-' }}</span></td>
                                    <td class="font-mono font-bold text-[#016B61]">Rp
                                        {{ number_format($iuran->jumlah_pembayaran, 0, ',', '.') }}</td>
                                    <td><span class="badge badge-ghost badge-sm">Digital</span></td>
                                    <td class="text-sm text-gray-500">{{ $iuran->created_at->format('d M Y H:i') }}</td>
                                    <td class="text-center">
                                        <button
                                            onclick="openVerifyModal({{ json_encode($iuran) }}, '{{ asset('storage/' . $iuran->bukti_pembayaran) }}')"
                                            class="btn btn-sm btn-outline btn-primary border-[#016B61] text-[#016B61] hover:bg-[#016B61] hover:text-white">
                                            Periksa Bukti
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <input type="radio" name="my_tabs_1" role="tab"
            class="tab h-10 px-6 rounded-full bg-white data-checked:bg-[#016B61] data-checked:text-white shadow-sm"
            aria-label="Riwayat Transaksi" />
        <div role="tabpanel" class="tab-content bg-white border border-gray-100 rounded-2xl p-6 mt-4 shadow-sm">
            <!-- Tabel Riwayat -->
            <div class="overflow-x-auto">
                <table class="table">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th>Warga</th>
                            <th>Periode</th>
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historyIurans as $iuran)
                            <tr class="hover:bg-gray-50">
                                <td>
                                    <div class="font-bold text-gray-700">{{ $iuran->warga->nama }}</div>
                                    <div class="text-xs text-gray-400">{{ $iuran->no_pembayaran }}</div>
                                </td>
                                <td><span class="badge badge-ghost">{{ $iuran->periode ?? '-' }}</span></td>
                                <td class="font-mono">Rp {{ number_format($iuran->jumlah_pembayaran, 0, ',', '.') }}</td>
                                <td>
                                    @if ($iuran->metode_pembayaran == 'Cash')
                                        <span class="badge badge-outline badge-success text-xs">Cash</span>
                                    @else
                                        <span class="badge badge-outline badge-info text-xs">Digital</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($iuran->status_pembayaran == 'Diterima')
                                        <span
                                            class="badge bg-green-100 text-green-700 border-none font-semibold">Diterima</span>
                                    @else
                                        <span
                                            class="badge bg-red-100 text-red-700 border-none font-semibold">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-sm text-gray-500">{{ $iuran->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $historyIurans->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL 1: VERIFIKASI PEMBAYARAN --}}
    <dialog id="modal_verify" class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-xl mb-4 border-b pb-2">Verifikasi Pembayaran</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kiri: Gambar Bukti -->
                <div
                    class="bg-gray-100 rounded-xl flex items-center justify-center h-80 border border-gray-200 overflow-hidden">
                    <img id="modal-img-bukti" src="" alt="Bukti"
                        class="object-contain h-full w-full cursor-zoom-in" onclick="window.open(this.src, '_blank')">
                </div>

                <!-- Kanan: Detail & Aksi -->
                <div class="flex flex-col justify-center space-y-4">
                    <div>
                        <label class="text-xs text-gray-500 uppercase font-bold">Nama Warga</label>
                        <p class="text-lg font-semibold text-gray-800" id="modal-verify-nama">-</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 uppercase font-bold">Jumlah Transfer</label>
                        <p class="text-2xl font-mono font-bold text-[#016B61]" id="modal-verify-jumlah">-</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 uppercase font-bold">No. Pembayaran</label>
                        <p class="text-md text-gray-600" id="modal-verify-no">-</p>
                    </div>

                    <div class="divider">Aksi</div>

                    <div class="flex gap-3">
                        <button onclick="submitVerification('Ditolak')" class="btn btn-error text-white flex-1"
                            id="btn-bg"><span class="" id="btn-tolak">Tolak</span></button>
                        <button onclick="submitVerification('Diterima')"
                            class="btn bg-(--bg-tertiary) hover:bg-(--bg-secondary) text-white flex-1" id="btn-bg1">
                            <span class="" id="btn-terima">Terima</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </dialog>

    {{-- MODAL 2: INPUT MANUAL (CASH) --}}
    <dialog id="modal_input_manual" class="modal modal-top px-auto md:px-40 lg:px-80 pt-20">
        <div class="modal-box rounded-t-2xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg mb-4 text-[#016B61]">Catat Pembayaran Tunai</h3>
            <form action="{{ route('rt.kelola.iuran.store') }}" method="POST">
                @csrf

                <div class="form-control w-full mb-4">
                    <label class="label"><span class="label-text">Pilih Warga</span></label>
                    <select name="warga_id" class="select select-bordered w-full" required>
                        <option value="" disabled selected>-- Pilih Warga --</option>
                        @foreach ($wargas as $warga)
                            <option value="{{ $warga->id }}">{{ $warga->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-control w-full mb-4">
                    <label class="label"><span class="label-text">Untuk Pembayaran</span></label>
                    <select name="periode" class="select select-bordered w-full h-12 max-h-12" required>
                        @php
                            $currentMonth = now()->translatedFormat('F Y');
                            $currentYear = now()->translatedFormat('Y');
                            $year = [
                                'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember',
                            ];
                        @endphp
                        <option value="" disabled selected>-- Pilih Periode --</option>
                        @if (Auth::user()->rt->jenis_iuran == 'Mingguan')
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $currentMonth }} - Minggu {{ $i }}">
                                    {{ $currentMonth }} - Minggu {{ $i }}</option>
                            @endfor
                        @else
                            @for ($i = 0; $i < 12; $i++)
                                <option value="{{ `$year[$i] $currentYear` }}">{{ $year[$i] }}</option>
                            @endfor
                        @endif
                    </select>
                </div>

                <div class="form-control w-full mb-6">
                    <label class="label"><span class="label-text">Jumlah (Rp)</span></label>
                    <input type="number" name="jumlah_pembayaran" class="input input-bordered w-full"
                        placeholder="Contoh: 5000" min="1000" required />
                </div>

                <button type="submit" class="btn bg-[#016B61] hover:bg-[#328E6E] text-white w-full">Simpan
                    Catatan</button>
            </form>
        </div>
    </dialog>

    <dialog id="modal_settings" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg mb-4 text-[#016B61]">Atur Tarif Iuran</h3>
            <form action="{{ route('rt.kelola.iuran.settings') }}" method="POST">
                @csrf

                <div class="form-control w-full mb-4">
                    <label class="label"><span class="label-text">Jenis Iuran</span></label>
                    <select name="jenis_iuran" class="select select-bordered w-full">
                        <option value="Mingguan" {{ $rt->jenis_iuran == 'Mingguan' ? 'selected' : '' }}>Mingguan</option>
                        <option value="Bulanan" {{ $rt->jenis_iuran == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                    </select>
                    <label class="label"><span class="label-text-alt text-gray-500">Frekuensi tagihan ke
                            warga.</span></label>
                </div>

                <div class="form-control w-full mb-6">
                    <label class="label"><span class="label-text">Nominal (Rp)</span></label>
                    <input type="number" name="biaya_iuran" class="input input-bordered w-full"
                        value="{{ $rt->biaya_iuran }}" min="0" required />
                </div>

                <div class="bg-yellow-50 p-3 rounded-lg text-xs text-yellow-700 mb-4">
                    Perubahan ini akan berlaku untuk tagihan baru. Tagihan lama yang sudah dibayar tidak akan berubah.
                </div>

                <button type="submit" class="btn bg-[#016B61] hover:bg-[#328E6E] text-white w-full">Simpan
                    Perubahan</button>
            </form>
        </div>
    </dialog>
    @vite('resources/js/utility/iuran_rt.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentIuranId = null;

        function openVerifyModal(iuranData, imgUrl) {
            currentIuranId = iuranData.id;
            document.getElementById('modal-verify-nama').textContent = iuranData.warga.nama;
            document.getElementById('modal-verify-jumlah').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(
                iuranData.jumlah_pembayaran);
            document.getElementById('modal-verify-no').textContent = iuranData.no_pembayaran;
            document.getElementById('modal-img-bukti').src = imgUrl;

            document.getElementById('modal_verify').showModal();
        }

        function submitVerification(status) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const btnTolak = document.getElementById('btn-tolak')
            const btnTerima = document.getElementById('btn-terima')
            const btnBgTolak = document.getElementById('btn-bg')
            const btnBgTerima = document.getElementById('btn-bg1')
            if (status == 'Diterima') {
                btnTerima.classList.add('loading', 'loading-dots', 'loading-md');
                btnBgTerima.classList.add('bg-green-900', 'disabled', 'cursor-none');
                fetch(`/rt/kelola-iuran/verify/${currentIuranId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            status: status
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            btnTerima.classList.remove('loading', 'loading-dots', 'loading-md');
                            btnBgTerima.classList.remove('bg-green-900', 'disabled', 'cursor-none');
                            document.getElementById('modal_verify').close();
                            Swal.fire('Berhasil!', data.message, 'success').then(() => location.reload());
                        }
                    });
            } else {
                btnTolak.classList.add('loading', 'loading-dots', 'loading-md');
                btnBgTolak.classList.add('bg-red-900', 'disabled', 'cursor-none');
                fetch(`/rt/kelola-iuran/verify/${currentIuranId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            status: status
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            btnTolak.classList.remove('loading', 'loading-dots', 'loading-md');
                            btnBgTolak.classList.remove('bg-red-900', 'disabled', 'cursor-none');
                            document.getElementById('modal_verify').close();
                            Swal.fire('DiTolak!', data.message, 'warning').then(() => location.reload());
                        }
                    });
            }
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonColor: '#016B61'
            });
        @endif
    </script>
@endsection
