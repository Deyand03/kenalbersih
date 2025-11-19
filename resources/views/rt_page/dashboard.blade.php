@extends('layouts.sidebar')
@section('title', 'Dashboard RT')

@section('content')
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-3">
            <div class="bg-gradient-to-br from-purple-500 to-purple-700 p-2 rounded-lg shadow-lg shadow-purple-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-house-door-fill"
                    viewBox="0 0 16 16">
                    <path
                        d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                <p class="text-sm text-gray-500">Overview of your RT management</p>
            </div>
        </div>

        <!-- Form Filter Tahun & Bulan -->
        <form action="{{ route('dashboard') }}" method="GET"
              class="flex flex-wrap items-center gap-3 bg-white p-2 px-4 rounded-xl shadow-sm border border-gray-100">

            <!-- Filter Bulan -->
            <div class="form-control w-full md:w-auto">
                <select name="bulan" class="select select-bordered select-sm w-full md:w-32 focus:border-purple-500 focus:ring-purple-500">
                    @foreach(range(1, 12) as $bulan)
                        <option value="{{ $bulan }}" {{ $bulan == $selectedBulan ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Tahun -->
            <div class="form-control w-full md:w-auto">
                <select name="tahun" class="select select-bordered select-sm w-full md:w-28 focus:border-purple-500 focus:ring-purple-500">
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
            <button type="submit" class="btn btn-sm bg-purple-600 hover:bg-purple-700 text-white border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter
            </button>
        </form>
    </div>

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Card 1: Sampah Organik (Pink Gradient) -->
        <div
            class="relative overflow-hidden bg-gradient-to-r from-rose-400 to-red-500 rounded-xl p-6 text-white shadow-lg shadow-red-500/30 transition-transform hover:-translate-y-1">
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
            class="relative overflow-hidden bg-gradient-to-r from-blue-400 to-cyan-500 rounded-xl p-6 text-white shadow-lg shadow-blue-500/30 transition-transform hover:-translate-y-1">
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
            class="relative overflow-hidden bg-gradient-to-r from-emerald-400 to-teal-500 rounded-xl p-6 text-white shadow-lg shadow-emerald-500/30 transition-transform hover:-translate-y-1">
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

    <!-- Chart Section (Card Style Putih) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Line Chart (Besar) -->
        <div class="bg-white p-6 rounded-xl shadow-sm lg:col-span-2 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-800">Visit And Sales Statistics</h3>
                <div class="flex gap-2">
                    <span class="badge badge-ghost badge-xs bg-purple-100 text-purple-600">ORG</span>
                    <span class="badge badge-ghost badge-xs bg-red-100 text-red-600">NON</span>
                </div>
            </div>
            <div class="relative h-64 w-full">
                <canvas id="line-chart"></canvas>
            </div>
        </div>

        <!-- Pie Chart (Kecil) -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Traffic Sources</h3>
            <div class="relative h-64 flex justify-center">
                <canvas id="pie-chart"></canvas>
            </div>
        </div>
    </div>
@endsection
