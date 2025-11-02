@props(['rts', 'defaultRt'])
<div>
    <div class="">
        <svg viewBox="0 0 1919 235" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M6.54785 0C4.81639 1.79796 3.75 4.24133 3.75 6.93457V45.2686C3.7501 47.8172 4.62521 50.1672 6.4043 51.9922C28.462 74.6169 183.328 228.213 295.826 200.062C379.298 179.175 452.204 161.914 531.5 123.949C738.6 24.7945 807.469 279.289 1026.02 228.038C1115.94 206.95 1178.99 136.44 1270 148.896C1320.89 155.861 1354.41 170.13 1404.62 182.425C1531.4 213.474 1660.34 2.48267 1742.5 123.949C1801.14 210.648 1887.68 202.642 1913.33 198.014C1915.72 197.583 1917.69 196.242 1919 194.394V235H0V0H6.54785ZM1919 1.2832C1918.69 0.826361 1918.34 0.397836 1917.95 0H1919V1.2832Z"
                fill="#F1FCFF" />
        </svg>
    </div>
    <div class="bg-[#F1FCFF] h-fit pb-20">
        <div class="flex flex-col items-center pb-18">
            <h1 class="text-center text-2xl md:text-[2.5rem] font-bold mb-1 text-black/75 pt-18" id="volume-sampah">Volume
                Sampah
            </h1>
            <div style="background-image: url({{ asset('svg/divider.svg') }})"
                class="object-cover bg-no-repeat bg-center w-10 rounded md:w-full h-[5px]"></div>
        </div>
        {{-- Chart Content --}}
        <div class="flex flex-col px-10 md:px-20">
            {{-- Dropdown --}}
            <form action="{{ route('homepage') }}#volume-sampah" method="get">
                <div class="flex flex-col gap-3 max-w-[44vw] w-full">
                    {{-- Input RT --}}
                    <div class="w-[320px]">
                        <span class="font-semibold text-lg">Masukan No RT:</span>
                        <select class="select" name="no_rt">
                            <option disabled selected >RT {{ $defaultRt->rt->no_rt }}</option>
                            @foreach ($rts as $rt)
                                <option value="{{ $rt->rt->id }}">RT {{ $rt->rt->no_rt }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Input Tahun --}}
                    <div class="w-[320px]">
                        <span class="font-semibold text-lg">Pilih Tahun:</span>
                        <input type="number" class="input" placeholder="Tahun" list="tahun" />
                        <datalist id="tahun">
                            <option value="2021"></option>
                            <option value="2022"></option>
                            <option value="2023"></option>
                            <option value="2024"></option>
                        </datalist>
                    </div>
                    {{-- Tombol Cari --}}
                    <div>
                        <button
                            class="bg-(--bg-tertiary) text-white rounded-lg px-3 py-2 transition-all duration-300 ease-in-out hover:scale-103 hover:shadow-md active:scale-100 transform-gpu will-change-transform font-medium">Tampilkan</button>
                    </div>
                </div>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-10">
                <div class="h-64 lg:h-96 aspect-auto bg-white rounded-lg shadow-lg flex items-center justify-center">
                    <span class="font-semibold text-xl text-black/50">[Chart 1]</span>
                </div>
                <div class="h-64 lg:h-96 aspect-auto bg-white rounded-lg shadow-lg flex items-center justify-center">
                    <span class="font-semibold text-xl text-black/50">[Chart 2]</span>
                </div>
            </div>
        </div>
    </div>
</div>
