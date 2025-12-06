<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    {{-- Load resources sesuai snippet kamu (chart_admin.js) --}}
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js', 'resources/js/utility/chart_admin.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">

    {{-- FullCalendar CDN --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <style>
        /* Define custom green color variables for clarity */
        :root {
            --color-primary-green: #016B61;
            --color-light-green: #E1EEBC;
            /* From homepage pallete */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2edf3;
            /* Keep light background */
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c7c7c7;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Styling Active State Menu (Green/Teal Theme) */
        .menu a.active {
            position: relative;
            background-color: var(--color-light-green) !important;
            /* Light Green BG */
            color: var(--color-primary-green) !important;
            /* Dark Green Text */
            border-left: 4px solid var(--color-primary-green);
            /* Dark Green Border */
            font-weight: 600;
        }

        .menu a:not(.active) {
            border-left: 4px solid transparent;
        }

        /* Styling FullCalendar override (Keep default for now, but menu is green) */
        .fc-toolbar-title {
            font-size: 1.25rem !important;
            font-weight: 600;
            color: #374151;
        }

        .fc-button {
            background-color: #9333ea !important;
            border-color: #9333ea !important;
            text-transform: capitalize;
            font-weight: 500;
        }

        .fc-button:hover {
            background-color: #7e22ce !important;
            border-color: #7e22ce !important;
        }

        .fc-button-active {
            background-color: #6b21a8 !important;
            border-color: #6b21a8 !important;
        }

        .fc-event {
            cursor: pointer;
            border: none;
            padding: 2px 4px;
            font-size: 0.85rem;
        }

        .fc-daygrid-day.fc-day-today {
            background-color: #f3e8ff !important;
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Navbar Modern Putih -->
            <nav class="navbar w-full bg-white shadow-sm sticky top-0 z-50 px-6 h-16">
                <div class="flex-1">
                    <!-- Tombol Hamburger untuk Mobile -->
                    <label for="my-drawer-4" class="btn btn-ghost btn-circle lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </label>

                    <a href="{{ route('homepage') }}"
                        class="hidden md:flex items-center gap-2 text-sm text-gray-500 hover:text-[#016B61] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span class="font-medium">Kembali ke Homepage</span>
                    </a>
                </div>

                <!-- Profile Section -->
                <div class="flex items-center gap-4">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-geo-alt text-[#016B61]" viewBox="0 0 16 16">
                            <path
                                d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                    </div>
                    <div>
                        RT {{ Auth::user()->rt->no_rt ?? '-' }}, {{ Auth::user()->rt->alamat_rumah ?? 'Mendalo Indah' }}
                    </div>
                </div>
            </nav>

            <!-- Main Content Wrapper -->
            <main class="flex-1 p-6 bg-[#f2edf3]">
                @yield('content')
            </main>
        </div>

        <!-- Sidebar / Drawer Side -->
        <div class="drawer-side z-50">
            <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
            <aside class="bg-white min-h-full w-64 flex flex-col shadow-lg">
                <!-- Sidebar Header -->
                <div class="h-16 flex items-center justify-center px-6 border-b border-gray-100">
                    {{-- Logo Kenal Bersih Hijau --}}
                    <span class="text-2xl font-bold text-[#016B61]">Kenal</span><span
                        class="text-2xl font-bold text-gray-700">Bersih</span>
                </div>

                <!-- User Profile di Sidebar  -->
                <div class="p-6 flex items-center gap-3 pb-2">
                    <div class="avatar">
                        <div class="w-10 rounded-full">
                            {{-- Background Avatar Hijau --}}
                            <img
                                src="{{ 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->rt->nama ?? 'Admin') . '&background=016B61&color=fff&size=128' }}" />
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span
                            class="font-bold text-sm text-gray-700">{{ Str::limit(Auth::user()->rt->nama ?? 'Admin', 15) }}</span>
                        <span class="text-xs text-gray-400">Pengurus RT {{ Auth::user()->rt->no_rt ?? '-' }}</span>
                    </div>
                </div>

                {{--  Menu Items --}}
                <ul class="menu w-full px-4 text-gray-600 font-medium gap-1 flex-1 flex flex-col pb-6">

                    <div class="pt-2 px-4 mb-2">
                        <h3 class="text-xs font-semibold text-gray-400 uppercase">Menu Utama</h3>
                    </div>

                    {{-- 1. Dashboard --}}
                    <li>
                        {{-- Warna hover diganti ke Hijau, active state diurus CSS atas --}}
                        <a href="{{ route('dashboard') }}"
                            class="{{ request()->routeIs('dashboard') ? 'active' : 'hover:text-[#016B61]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-pie-chart" viewBox="0 0 16 16">
                                <path
                                    d="M7.5 1.018a7 7 0 0 0-4.79 11.566L7.5 7.793zm1 0V7.5h6.482A7 7 0 0 0 8.5 1.018M14.982 8.5H8.207l-4.79 4.79A7 7 0 0 0 14.982 8.5M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8" />
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    {{-- 2. Laporan Sampah --}}
                    <li>
                        <a href="{{ route('rt.laporan_sampah') }}"
                            class="{{ request()->routeIs('rt.laporan_sampah') ? 'active' : 'hover:text-[#016B61]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="-translate-x-0.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            Laporan Sampah
                        </a>
                    </li>

                    {{-- 3. Iuran Warga --}}
                    <li>
                        <a href="{{ route('rt.kelola.iuran') }}"
                            class="{{ request()->routeIs('rt.kelola.iuran') ? 'active' : 'hover:text-[#016B61]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-wallet2" viewBox="0 0 16 16">
                                <path
                                    d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                            </svg>
                            Iuran Warga
                        </a>
                    </li>

                    {{-- 4. Laporan Pengeluaran --}}
                    <li>
                        <a href="{{ route('rt.pengeluaran') }}"
                            class="{{ request()->routeIs('rt.pengeluaran') ? 'active' : 'hover:text-[#016B61]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">
                                <path
                                    d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z" />
                                <path
                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                <path
                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                            </svg>
                            Pengeluaran
                        </a>
                    </li>
                    {{-- Data Warga --}}
                    <li>
                        <a href="{{ route('rt.data_warga') }}"
                            class="{{ request()->routeIs('rt.data_warga') ? 'active' : 'hover:text-[#016B61]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                                <path
                                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z" />
                            </svg>
                            Data Warga
                        </a>
                    </li>

                    <div class="pt-8 px-4 mb-2">
                        <h3 class="text-xs font-semibold text-gray-400 uppercase">Akun</h3>
                    </div>

                    {{-- 5. Profile --}}
                    <li>
                        <a href="{{ route('rt.profile') }}" class="hover:text-[#016B61]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                            Profile
                        </a>
                    </li>

                    {{-- 6. Logout --}}
                    <form action="{{ route('logout') }}" method="POST" class="hover:text-red-500 mt-auto">
                        @csrf
                        <li class="p-0">
                            <button type="submit" class="w-full text-left flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar
                            </button>
                        </li>
                    </form>
                </ul>
            </aside>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
