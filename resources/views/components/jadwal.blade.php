<div class="pt-20 md:pt-32">
    <div class="pb-8 flex flex-col items-center">
        <h2 class="text-center font-bold text-3xl md:text-[2.5rem] mb-3 text-black/75" data-animasi="fade-down">Jadwal
            Angkut Sampah</h2>
        <div style="background-image: url({{ asset('svg/divider.svg') }})"
            class="object-cover bg-no-repeat bg-center rounded w-12 md:w-50 h-[5px]"></div>
    </div>

    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-4 md:p-6" data-animasi="fade-up">
        <div class="flex justify-end gap-4 mb-4 px-2">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-[#10b981]"></div> {{-- Emerald-500 --}}
                <span class="text-sm font-medium text-gray-600">Sudah Diangkut</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-[#9ca3af]"></div> {{-- Gray-400 --}}
                <span class="text-sm font-medium text-gray-600">Belum Diangkut</span>
            </div>
        </div>

        <div id="calendar"></div>
    </div>
</div>
