<div class="pt-50">
    <div class="pb-20">
        <h2 class="text-center font-bold text-2xl md:text-[2.5rem] mb-3">Jadwal Angkut Sampah</h2>
        <div style="background-image: url({{ asset('svg/divider.svg') }})"
            class="object-cover bg-no-repeat bg-center w-12 rounded md:w-full h-[5px]"></div>
    </div>
    <div class="">
        <div class="px-20" id="calendar"></div>
    </div>
    @vite('resources/js/utility/jadwal_angkut.js')
</div>
