@props([
    'all_rts',
    'selectedRtId',
    'selectedTahun',
    'dataBulanan',
])

    <div class="">
        <div class="flex flex-col items-center pb-18">
            <h1 class="text-center text-2xl md:text-[2.5rem] font-bold mb-1 text-black/75 pt-18" id="volume-sampah">
                Volume Sampah
            </h1>
            <div style="background-image: url({{ asset('svg/divider.svg') }})"
                class="object-cover bg-no-repeat bg-center w-10 rounded md:w-full h-[5px]"></div>
        </div>
        {{-- Chart Content --}}
        <div class="flex flex-col">
            {{-- Dropdown --}}
            <form action="{{ route('homepage') }}#volume-sampah" method="get">
                <div class="flex flex-col gap-3 max-w-[44vw] w-full">
                    {{-- Input RT --}}
                    <div class="w-[320px]">
                        <span class="font-semibold text-lg">Masukan No RT:</span>
                        <select class="select" name="no_rt">
                            @foreach ($all_rts as $rt)
                                {{--
                                GANTI:
                                1. Value pakai $rt->id (sesuai controller)
                                2. Tambahkan 'selected' jika ID-nya sama dengan $selectedRtId
                                --}}
                                <option value="{{ $rt->id }}" {{ $rt->id == $selectedRtId ? 'selected' : '' }}>
                                    RT {{ $rt->no_rt }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Input Tahun --}}
                    <div class="w-[320px]">
                        <span class="font-semibold text-lg">Pilih Tahun:</span>
                        {{--
                        GANTI:
                        Looping <select> tahun dihapus.
                            Diganti dengan input number sederhana yang nilainya
                            sudah disiapkan oleh controller ($selectedTahun).
                            Ini jauh lebih bersih dan bebas duplikat.
                            (Asumsikan kamu punya style untuk class 'input')
                            --}}
                            <input class="select" {{-- <-- Pakai class 'select' agar styling sama --}} type="number"
                                name="tahun" value="{{ $selectedTahun }}" placeholder="Contoh: 2024">
                    </div>

                    {{-- Tombol Cari --}}
                    <div>
                        <button
                            class="bg-(--bg-tertiary) text-white rounded-lg px-3 py-2 transition-all duration-300 ease-in-out hover:scale-103 hover:shadow-md active:scale-100 transform-gpu will-change-transform font-medium">Tampilkan</button>
                    </div>
                </div>
            </form>

            {{--
            Grid untuk Chart
            (Sesuai permintaanmu, bagian ini tidak diubah logikanya,
            HANYA diganti nama variabelnya saja)
            --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-10">

                {{-- GANTI: Cek menggunakan $dataBulanan --}}
                @if ($dataBulanan->isNotEmpty())

                    {{-- GANTI: Loop menggunakan $dataBulanan --}}
                    @foreach ($dataBulanan as $data_bulan)
                        {{-- Ini akan membuat 2 box untuk SETIAP bulan (misal: 12 bulan = 24 box) --}}
                        <div class="h-64 lg:h-96 aspect-auto bg-white rounded-lg shadow-lg flex items-center justify-center">
                            <span class="font-semibold text-xl text-black/50">
                                {{-- Ini hanya data 1 bulan --}}
                                {{ $data_bulan->bulan }}
                            </span>
                        </div>
                        <div class="h-64 lg:h-96 aspect-auto bg-white rounded-lg shadow-lg flex items-center justify-center">
                            <span class="font-semibold text-xl text-black/50">[Chart 2]</span>
                        </div>
                    @endforeach
                @else
                    <div class="h-64 lg:h-96 aspect-auto bg-white rounded-lg shadow-lg flex items-center justify-center">
                        <span class="font-semibold text-xl text-black/50">Data tidak tersedia</span>
                    </div>
                    <div class="h-64 lg:h-96 aspect-auto bg-white rounded-lg shadow-lg flex items-center justify-center">
                        <span class="font-semibold text-xl text-black/50">Data tidak tersedia</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
