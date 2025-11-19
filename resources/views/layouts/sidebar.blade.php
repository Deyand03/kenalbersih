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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- FullCalendar CDN --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <style>
        /* Define custom green color variables for clarity */
        :root {
            --color-primary-green: #016B61;
            --color-light-green: #E1EEBC; /* From homepage pallete */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2edf3; /* Keep light background */
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c7c7c7; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }

        /* Styling Active State Menu (Green/Teal Theme) */
        .menu a.active {
            position: relative;
            background-color: var(--color-light-green) !important; /* Light Green BG */
            color: var(--color-primary-green) !important; /* Dark Green Text */
            border-left: 4px solid var(--color-primary-green); /* Dark Green Border */
            font-weight: 600;
        }
        .menu a:not(.active) {
            border-left: 4px solid transparent;
        }
        /* Styling FullCalendar override (Keep default for now, but menu is green) */
        .fc-toolbar-title { font-size: 1.25rem !important; font-weight: 600; color: #374151; }
        .fc-button { background-color: #9333ea !important; border-color: #9333ea !important; text-transform: capitalize; font-weight: 500; }
        .fc-button:hover { background-color: #7e22ce !important; border-color: #7e22ce !important; }
        .fc-button-active { background-color: #6b21a8 !important; border-color: #6b21a8 !important; }
        .fc-event { cursor: pointer; border: none; padding: 2px 4px; font-size: 0.85rem; }
        .fc-daygrid-day.fc-day-today { background-color: #f3e8ff !important; }
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

                    <a href="{{ route('homepage') }}" class="hidden md:flex items-center gap-2 text-sm text-gray-500 hover:text-[#016B61] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        <span class="font-medium">Kembali ke Homepage</span>
                    </a>
                </div>

                <!-- Profile Section -->
                <div class="flex items-center gap-4">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-geo-alt text-[#016B61]" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
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

                <!-- Menu Items -->
                {{-- NOTE: Warna aktif diatur di <style> block --}}
                <ul class="menu w-full px-4 text-gray-600 font-medium gap-1 flex-1 flex flex-col pb-6">

                    <div class="pt-2 px-4 mb-2">
                        <h3 class="text-xs font-semibold text-gray-400 uppercase">Menu Utama</h3>
                    </div>

                    <!-- 1. Dashboard -->
                    <li>
                        {{-- Warna hover diganti ke Hijau, active state diurus CSS atas --}}
                        <a href="{{ route('dashboard') }}"
                            class="{{ request()->routeIs('dashboard') ? 'active' : 'hover:text-[#016B61]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">
                                <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z" />
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    <!-- 2. Laporan Sampah -->
                    <li>
                        <a href="{{ route('rt.laporan_sampah') }}"
                            class="{{ request()->routeIs('rt.laporan_sampah') ? 'active' : 'hover:text-[#016B61]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
                                <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1" />
                            </svg>
                            Laporan Sampah
                        </a>
                    </li>

                    <!-- 3. Keuangan -->
                    <li>
                        <a href="#" class="hover:text-[#016B61]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                            </svg>
                            Keuangan
                        </a>
                    </li>

                    <div class="pt-8 px-4 mb-2">
                        <h3 class="text-xs font-semibold text-gray-400 uppercase">Akun</h3>
                    </div>

                    <!-- 4. Profile -->
                    <li>
                        <a href="#" class="hover:text-[#016B61]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                            Profile
                        </a>
                    </li>

                    <!-- 5. Logout -->
                    <form action="{{ route('logout') }}" method="POST" class="hover:text-red-500 mt-auto">
                        @csrf
                        <li class="p-0">
                            <button type="submit" class="w-full text-left flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
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
