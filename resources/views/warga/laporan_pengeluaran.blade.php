@extends('layouts.index')

@section('title', 'Transparansi Keuangan')

@section('content')
    <div
        class="fixed inset-0 pointer-events-none z-0 opacity-[0.03]">
    </div>

    {{-- Background Gradient Halus --}}
    <div class="fixed inset-0 pointer-events-none z-[-1] bg-linear-to-b from-[#016B61]/5 via-transparent to-transparent">
    </div>

    <div class="min-h-screen pt-20 pb-12 relative">

        <!-- HEADER JUDUL HALAMAN (Glass Effect + Noise) -->
        <div class="relative z-10 mb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Box dengan efek kaca buram dan border halus --}}
                <div
                    class="bg-white/70 backdrop-blur-xl border border-white/40 p-6 md:p-8 rounded-3xl shadow-sm relative overflow-hidden">
                    <!-- Dekorasi Latar Belakang Abstrak -->
                    <div
                        class="absolute -top-24 -right-24 w-64 h-64 bg-[#016B61]/10 rounded-full blur-3xl pointer-events-none">
                    </div>
                    <div
                        class="absolute -bottom-24 -left-24 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none">
                    </div>

                    <div class="relative z-10">
                        <div class="badge bg-[#016B61]/10 text-[#016B61] border-none font-bold mb-3 px-3 py-2 h-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="mr-2">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            Portal Warga
                        </div>
                        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-800 tracking-tight mb-4">
                            Transparansi Keuangan RT
                        </h1>
                        <p class="text-lg text-slate-600 max-w-2xl leading-relaxed">
                            Akses laporan penggunaan dana iuran lingkungan secara terbuka. Pilih RT dan periode untuk
                            melihat detail pemasukan dan pengeluaran. Wujud komitmen kami untuk pengelolaan yang jujur dan
                            akuntabel.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- FILTER BAR (Desain Ngambang + Utilitas DaisyUI) -->
            <div class="flex md:sticky border-green-600 border rounded-2xl top-24 z-30 mb-10">
                <div
                    class="bg-white/80 backdrop-blur-md border border-white/50 p-4 rounded-2xl w-full shadow-lg shadow-slate-200/50 transition-all hover:shadow-xl">
                    <form action="{{ route('pengeluaran') }}" method="GET"
                        class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                        <!-- Filter RT -->
                        <div class="md:col-span-5 form-control">
                            <label class="label py-0 mb-1">
                                <span
                                    class="label-text text-xs font-bold uppercase text-slate-400 tracking-wider">Lingkungan</span>
                            </label>
                            {{-- Pake 'select select-bordered' tapi kita custom border focus-nya --}}
                            <select name="rt_id"
                                class="select select-bordered w-full focus:border-[#016B61] focus:ring-1 focus:ring-[#016B61] focus:outline-none bg-slate-50/80 font-medium">
                                <option value="">Semua Lingkungan Desa</option>
                                @foreach ($list_rt as $rt)
                                    <option value="{{ $rt->id }}" {{ request('rt_id') == $rt->id ? 'selected' : '' }}>
                                        RT {{ $rt->no_rt }} - {{ $rt->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Bulan -->
                        <div class="md:col-span-3 form-control">
                            <label class="label py-0 mb-1">
                                <span
                                    class="label-text text-xs font-bold uppercase text-slate-400 tracking-wider">Bulan</span>
                            </label>
                            <select name="bulan"
                                class="select select-bordered w-full focus:border-[#016B61] focus:ring-1 focus:ring-[#016B61] focus:outline-none bg-slate-50/80 font-medium">
                                <option value="">Semua Bulan</option>
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Tahun -->
                        <div class="md:col-span-2 form-control">
                            <label class="label py-0 mb-1">
                                <span
                                    class="label-text text-xs font-bold uppercase text-slate-400 tracking-wider">Tahun</span>
                            </label>
                            <select name="tahun"
                                class="select select-bordered w-full focus:border-[#016B61] focus:ring-1 focus:ring-[#016B61] focus:outline-none bg-slate-50/80 font-medium">
                                @foreach ($available_years as $year)
                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                        {{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol Submit (Pake class 'btn' dasar + warna custom kita) -->
                        <div class="md:col-span-2">
                            <button type="submit"
                                class="btn bg-(--bg-secondary) hover:bg-[#015a52] text-white w-full border-none gap-2 shadow-md hover:shadow-lg hover:shadow-[#016B61]/20 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M22 3H2l8 9.46V19l4 2v-8.54L22 3z" />
                                </svg>
                                Terapkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Judul Filter Aktif (Pemanis) -->
            <div class="mb-6 flex items-center gap-3 animate-fade-in-up">
                <div class="bg-white p-2 rounded-full shadow-sm border border-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-[#016B61]">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-700">{{ $rtName }}</h2>
                <span
                    class="text-sm text-slate-500 hidden md:block border-l border-slate-300 pl-3 ml-2">{{ $rtDesc }}</span>
            </div>

            <!-- SUMMARY CARDS (Desain Interaktif 3D + Ikon) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 animate-fade-in-up animation-delay-100">
                <!-- Saldo Card -->
                <div
                    class="group bg-white p-6 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-100/50">
                    {{-- Dekorasi Hover --}}
                    <div
                        class="absolute -right-6 -top-6 w-32 h-32 bg-[#016B61]/5 rounded-full transition-transform group-hover:scale-150 duration-500">
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-[#016B61]/10 text-[#016B61] rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4" />
                                    <path d="M3 5v14a2 2 0 0 0 2 2h16v-5" />
                                    <path d="M18 12a2 2 0 0 0 0 4h4v-4Z" />
                                </svg>
                            </div>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Sisa Saldo Kas</p>
                        </div>
                        <h3
                            class="text-2xl md:text-3xl lg:text-4xl font-black text-slate-800 group-hover:text-[#016B61] transition-colors">
                            Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                        </h3>
                        <p class="text-xs text-slate-400 mt-2 font-medium flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            Akumulasi Total (Semua Waktu)
                        </p>
                    </div>
                </div>

                <!-- Pemasukan Card -->
                <div
                    class="group bg-white p-6 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Total Masuk</p>
                            <span
                                class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m5 12 7-7 7 7" />
                                    <path d="M12 19V5" />
                                </svg>
                                INCOME
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-emerald-600 mt-1">Rp
                            {{ number_format($totalMasuk, 0, ',', '.') }}</h3>
                        {{-- Pake 'progress' DaisyUI tapi warna custom --}}
                        <progress class="progress progress-success w-full mt-3 h-2" value="100" max="100"></progress> {{-- Warna Emerald-500 --}}
                    </div>
                </div>
                <!-- Pengeluaran Card -->
                <div
                    class="group bg-white p-6 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Total Keluar</p>
                            <span
                                class="bg-red-100 text-red-700 text-[10px] font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14" />
                                    <path d="m19 12-7 7-7-7" />
                                </svg>
                                EXPENSE
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-red-500 mt-1">Rp {{ number_format($totalKeluar, 0, ',', '.') }}
                        </h3>
                        {{-- Pake 'progress' DaisyUI tapi warna custom --}}
                        <progress class="progress w-full mt-3 h-2"
                            value="{{ $totalMasuk > 0 ? ($totalKeluar / $totalMasuk) * 100 : 0 }}" max="100"
                            style="--p: 239 68 68; --bc: 241 245 249;"></progress>
                    </div>
                </div>
            </div>

            <!-- MAIN CONTENT GRID (Layout Grid + Kartu Interaktif) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in-up animation-delay-200">

                <!-- CHART SECTION -->
                <div class="lg:col-span-2">
                    <div
                        class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 h-full flex flex-col relative overflow-hidden">
                        <div class="flex justify-between items-center mb-6 relative z-10">
                            <h3 class="font-bold text-slate-800 text-lg flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="text-[#016B61]">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <path d="M3 9h18" />
                                    <path d="M9 21V9" />
                                </svg>
                                Statistik Arus Kas
                            </h3>
                            <span
                                class="text-xs font-medium text-slate-500 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">6
                                Bulan Terakhir</span>
                        </div>

                        <!-- Chart Container -->
                        <div class="relative flex-grow min-h-[350px] w-full z-10">
                            <canvas id="guestChart"></canvas>
                        </div>

                        {{-- Dekorasi Latar Chart --}}
                        <div
                            class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-slate-50 to-transparent pointer-events-none z-0">
                        </div>
                    </div>
                </div>

                <!-- LIST SECTION (Kartu Interaktif + Custom Scrollbar) -->
                <div class="lg:col-span-1">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-slate-100 h-full flex flex-col overflow-hidden">
                        <div class="p-6 border-b border-slate-50 bg-slate-50/80 backdrop-blur-sm">
                            <h3 class="font-bold text-slate-800 text-lg flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="text-slate-400">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                    <line x1="9" x2="15" y1="10" y2="10" />
                                    <line x1="12" x2="12" y1="8" y2="12" />
                                </svg>
                                Riwayat Transaksi
                            </h3>
                            <p class="text-xs text-slate-500 mt-1 ml-7">Filter Aktif: Tahun {{ $selectedYear }}</p>
                        </div>

                        <!-- Scrollable List dengan Kartu Interaktif -->
                        <div class="flex-1 overflow-y-auto p-4 space-y-3 custom-scrollbar bg-slate-50/80">
                            @forelse($riwayat as $item)
                                <div
                                    class="group bg-white border border-slate-200/80 rounded-2xl p-4 hover:border-[#016B61]/30 hover:shadow-md hover:shadow-[#016B61]/5 hover:bg-[#016B61]/[0.02] transition-all duration-200">
                                    <div class="flex justify-between items-start mb-2">
                                        <span
                                            class="text-[10px] font-bold uppercase bg-slate-100 text-slate-500 px-2.5 py-1 rounded-lg tracking-wider group-hover:bg-white transition-colors">
                                            RT {{ $item->rt->no_rt }}
                                        </span>
                                        <span class="text-xs text-slate-400 font-medium flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect width="18" height="18" x="3" y="4" rx="2"
                                                    ry="2" />
                                                <line x1="16" x2="16" y1="2" y2="6" />
                                                <line x1="8" x2="8" y1="2" y2="6" />
                                                <line x1="3" x2="21" y1="10" y2="10" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                        </span>
                                    </div>

                                    <h4
                                        class="text-sm font-bold text-slate-700 mb-1 group-hover:text-[#016B61] transition-colors line-clamp-2">
                                        {{ $item->judul }}
                                    </h4>

                                    <div class="flex justify-between items-end mt-3">
                                        <span
                                            class="font-mono font-bold text-red-500 text-sm bg-red-50 px-2.5 py-1 rounded-lg group-hover:bg-white transition-colors">
                                            - Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </span>

                                        @if ($item->bukti_foto)
                                            <a href="{{ asset('storage/' . $item->bukti_foto) }}" target="_blank"
                                                class="p-2 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 transition-all hover:scale-105 hover:shadow-sm"
                                                title="Lihat Bukti Foto">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                                    <path d="M10 9H8" />
                                                    <path d="M16 13H8" />
                                                    <path d="M16 17H8" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <!-- Empty State yang Lebih Cantik -->
                                <div
                                    class="flex flex-col items-center justify-center h-64 text-center p-6 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/80 mx-4">
                                    <div
                                        class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-slate-500 font-bold">Belum ada data transaksi</p>
                                    <p class="text-slate-400 text-sm mt-1">Coba ubah filter bulan atau tahun di atas.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        <div class="p-4 border-t border-slate-100 bg-slate-50/80 backdrop-blur-sm">
                            {{ $riwayat->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- SCRIPT CHART (Konfigurasi Modern) -->
    @vite('resources/js/utility/laporan_pengeluaran.js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('guestChart');

        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = '#64748b';

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                        label: 'Pemasukan',
                        data: @json($chartData['pemasukan']),
                        backgroundColor: '#10b981', // Emerald-500
                        borderRadius: 6,
                        barThickness: 24, // Sedikit lebih tebal biar mantap
                        borderSkipped: false,
                        hoverBackgroundColor: '#059669', // Warna hover lebih gelap
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($chartData['pengeluaran']),
                        backgroundColor: '#ef4444', // Red-500
                        borderRadius: 6,
                        barThickness: 24,
                        borderSkipped: false,
                        hoverBackgroundColor: '#dc2626', // Warna hover lebih gelap
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8,
                            font: {
                                weight: '600'
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 16,
                        cornerRadius: 12,
                        titleFont: {
                            size: 14,
                            weight: 700
                        },
                        bodyFont: {
                            size: 13
                        },
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR',
                                        maximumFractionDigits: 0
                                    }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9',
                            drawBorder: false,
                            lineWidth: 1.5
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: '500'
                            },
                            padding: 10,
                            callback: function(value) {
                                if (value >= 1000000) return (value / 1000000) + ' Jt';
                                if (value >= 1000) return (value / 1000) + ' Rb';
                                return value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: '600'
                            },
                            padding: 10
                        }
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });
    </script>

    <style>
        /* Custom Scrollbar yang Lebih Halus */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
            border: 1px solid #f1f5f9;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }

        /* Utilitas Animasi Sederhana */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .animation-delay-100 {
            animation-delay: 0.1s;
        }

        .animation-delay-200 {
            animation-delay: 0.2s;
        }
    </style>
@endsection
