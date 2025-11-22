@props(['dataBulanan'])
<div class="flex flex-col max-w-6xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 pt-10">
        @if ($dataBulanan->isNotEmpty())
            @php
                $namaBulan = [
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember',
                ];
                $chartLabels = array_values($namaBulan);
                $databyBulan = $dataBulanan->keyBy('bulan');
                $dataOrganik = [];
                $dataNonOrganik = [];
                $dataB3 = [];

                for ($i = 1; $i <= 12; $i++) {
                    if (isset($databyBulan[$i])) {
                        $dataBulanIni = $databyBulan[$i];
                        $dataOrganik[] = $dataBulanIni->organik;
                        $dataNonOrganik[] = $dataBulanIni->non_organik;
                        $dataB3[] = $dataBulanIni->b3;
                    } else {
                        $dataOrganik[] = 0;
                        $dataNonOrganik[] = 0;
                        $dataB3[] = 0;
                    }
                }
            @endphp
            <div class="h-fit lg:h-96 aspect-auto bg-white rounded-xl shadow-lg p-4 md:p-6" id="chart-card"
                data-animasi="zoom-in">
                <div class="flex justify-between items-center gap-2">
                    <div class="font-semibold text-xl">
                        <span>Statistik Volume Sampah</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="text-[10px] bg-red-100 text-red-800 rounded-2xl px-1">
                            Organik
                        </div>
                        <div class="text-[10px] bg-blue-100 text-blue-800 rounded-2xl px-1">
                            Non-organik
                        </div>
                        <div class="text-[10px] bg-green-100 text-green-800 rounded-2xl px-1">
                            B3
                        </div>
                    </div>
                </div>
                <canvas id="line-chart" data-labels="{{ json_encode($chartLabels) }}"
                    data-organik="{{ json_encode($dataOrganik) }}" data-anorganik="{{ json_encode($dataNonOrganik) }}"
                    data-b3="{{ json_encode($dataB3) }}">
                </canvas>
            </div>
            <div class="h-fit overflow-hidden lg:h-96 aspect-auto bg-white rounded-xl shadow-lg flex p-4 md:p-6"
                id="pie-card" data-animasi="zoom-in" data-delay="200">
                <canvas id="pie-chart"></canvas>
            </div>
        @else
            <div
                class="h-64 lg:h-96 aspect-auto bg-white rounded-xl shadow-lg flex items-center justify-center col-span-1 md:col-span-2 p-6">
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <span class="mt-4 font-semibold text-xl text-black/50 block">Data tidak
                        tersedia</span>
                    <p class="text-gray-500">Silakan pilih RT atau Tahun yang berbeda.</p>
                </div>
            </div>
        @endif
    </div>
</div>
