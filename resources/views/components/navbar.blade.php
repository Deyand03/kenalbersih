<div class="navbar fixed bg-transparent px-0 md:px-16 z-50 text-black navbar-custom">
    <div class="navbar-start">
        {{-- Tombol Mobile --}}
        <div class="dropdown translate-y-1">
            <div tabindex="0" role="button" class="btn btn-ghost hover:btn-accent active:btn-accent mr-3 lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            {{-- Menu Dropdown Mobile --}}
            <ul tabindex="-1"
                class="menu menu-sm dropdown-content backdrop-blur-md rounded-box z-1 mt-3 w-52 p-2 shadow dropdown-mobile bg-white/70">
                <li><a href="{{ route('homepage') }}" class="py-2">Homepage</a></li>
                <li><a href="{{ route('laporan_sampah') }}" class="py-2">Lapor Sampah</a></li>
                <li><a href="{{ route('iuran') }}" class="py-2">Iuran</a></li>
                <li><a href="{{ route('pengeluaran') }}" class="py-2">Laporan Transparansi</a></li>
                <li><a href="{{ route('about') }}" class="py-2">About</a></li>
            </ul>
        </div>

        {{-- Logo --}}
        <a class="text-navbar transform-gpu translate-y-1"><span class="font-bold text-xl">Kenal</span><span
                class="font-bold text-xl web-name text-(--text-secondary)">Bersih</span></a>
    </div>

    {{-- Menu Navigasi Desktop --}}
    <div class="navbar-center hidden lg:flex text-navbar transform-gpu translate-y-1">
        @guest
            <ul class="flex items-center gap-2 px-1 text-base font-medium space-x-2">
                <li>
                    <a href="{{ route('homepage') }}" class="relative group px-3 py-2">
                        <span>Homepage</span>
                        <span
                            class="absolute bottom-1.5 left-0 w-full h-0.5 bg-linear-to-r from-(--bg-secondary) to-(--bg-primary) {{ request()->routeIs('homepage') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300 ease-out origin-left"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan_sampah') }}" class="relative group px-3 py-2">
                        <span>Lapor Sampah</span>
                        <span
                            class="absolute bottom-1.5 left-0 w-full h-0.5 bg-linear-to-r from-(--bg-secondary) to-(--bg-primary) {{ request()->routeIs('laporan_sampah') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300 ease-out origin-left"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengeluaran') }}" class="relative group px-3 py-2">
                        <span>Laporan Transparansi</span>
                        <span
                            class="absolute bottom-1.5 left-0 w-full h-0.5 bg-linear-to-r from-(--bg-secondary) to-(--bg-primary) {{ request()->routeIs('iuran') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300 ease-out origin-left"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('about') }}" class="relative group px-3 py-2">
                        <span>About</span>
                        <span
                            class="absolute bottom-1.5 left-0 w-full h-0.5 bg-linear-to-r from-(--bg-secondary) to-(--bg-primary) {{ request()->routeIs('about') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300 ease-out origin-left"></span>
                    </a>
                </li>
            </ul>
        @endguest
        @auth
            <ul class="menu menu-horizontal flex items-center gap-2 px-1 text-base font-medium space-x-2">
                <li>
                    <a href="{{ route('homepage') }}" class="hover:bg-transparent active:bg-transparent active:text-black relative group px-3 py-2">
                        <span>Homepage</span>
                        <span
                            class="absolute bottom-1.5 left-0 w-full h-0.5 bg-linear-to-r from-(--bg-secondary) to-(--bg-primary) {{ request()->routeIs('homepage') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300 ease-out origin-left"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan_sampah') }}" class="hover:bg-transparent active:bg-transparent active:text-black relative group px-3 py-2">
                        <span>Lapor Sampah</span>
                        <span
                            class="absolute bottom-1.5 left-0 w-full h-0.5 bg-linear-to-r from-(--bg-secondary) to-(--bg-primary) {{ request()->routeIs('laporan_sampah') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300 ease-out origin-left"></span>
                    </a>
                </li>
                <li>
                    <details>
                        <summary class="group hover:bg-transparent active:bg-transparent active:text-black">
                            <span>Keuangan</span>
                            <span class="absolute bottom-1.5 left-0 w-full h-[3px] bg-linear-to-r from-(--bg-secondary) to-(--bg-primary) {{ request()->routeIs('pengeluaran') || request()->routeIs('iuran') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300 ease-out origin-left"></span>
                        </summary>
                        <ul class="bg-white/50 rounded-t-none p-3" style="backdrop-filter: blur(8px)">
                            <li>
                                <a href="{{ route('iuran') }}" class="hover:bg-transparent active:bg-transparent active:text-black relative group px-3 py-2">
                                    <span>Bayar Iuran</span>
                                    <span
                                        class="absolute bottom-1.5 left-0 w-full h-0.5 bg-linear-to-r from-(--bg-secondary) to-(--bg-primary) scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-out origin-left"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pengeluaran') }}" class="hover:bg-transparent active:bg-transparent active:text-black relative group px-3 py-2">
                                    <span>Laporan Transparansi</span>
                                    <span
                                        class="absolute bottom-1.5 left-0 w-full h-0.5 bg-linear-to-r from-(--bg-secondary) to-(--bg-primary) scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-out origin-left"></span>
                                </a>
                            </li>
                        </ul>
                    </details>
                </li>
                <li>
                    <a href="{{ route('about') }}" class="hover:bg-transparent active:bg-transparent active:text-black relative group px-3 py-2">
                        <span>About</span>
                        <span
                            class="absolute bottom-1.5 left-0 w-full h-0.5 bg-linear-to-r from-(--bg-secondary) to-(--bg-primary) {{ request()->routeIs('about') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform duration-300 ease-out origin-left"></span>
                    </a>
                </li>
            </ul>
        @endauth
    </div>

    <div class="navbar-end">
        @guest
            <a href="{{ route('login') }}"
                class="text-navbar translate-y-1 btn bg-(--bg-tertiary) hover:scale-104 active:scale-100 active:bg-(--bg-secondary) hover:shadow-md shadow-none rounded-2xl transform-gpu transition-all duration-300 ease-in-out will-change-transform"><span
                    class="font-semibold text-white">Login</span></a>
        @endguest
        @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button"
                    class="btn btn-ghost btn-circle avatar transition-transform duration-300 hover:scale-110">
                    <div class="w-10 rounded-full ring-2 ring-primary/50 ring-offset-base-100 ring-offset-2">
                        @if (Auth::user()->role === 'warga' && Auth::user()->warga)
                            <img src="{{ 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->warga->nama) . '&background=201E43&color=fff&size=128' }}"
                                alt="" class="object-cover" />
                        @elseif (Auth::user()->role === 'rt' && Auth::user()->rt)
                            <img src="{{ 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->rt->nama) . '&background=201E43&color=fff&size=128' }}}"
                                alt="" class="object-cover" />
                        @endif
                    </div>
                </div>


                <ul tabindex="0"
                    class="menu dropdown-content bg-base-100/85 backdrop-blur-md rounded-box z-1 mt-4 w-64 p-2 shadow-xl border border-base-200/50">
                    {{-- Header Dropdown --}}
                    <li class="px-2 pt-2 pb-1">
                        <div class="flex flex-col pointer-events-none">
                            <p class="font-bold truncate">
                                {{ Auth::user()->role == 'warga' ? Auth::user()->warga->nama : Auth::user()->rt->nama }}
                            </p>
                            <p class="text-xs text-base-content/60 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </li>

                    <div class="divider my-1"></div>

                    {{-- Menu Items --}}
                    @if (Auth::user()->role === 'warga')
                        <li>
                            <a href="{{ route('profile') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Profile
                            </a>
                        </li>
                    @elseif(Auth::user()->role === 'rt')
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                Dashboard RT
                            </a>
                        </li>
                    @endif

                    <div class="divider my-1"></div>

                    {{-- Tombol Logout --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="flex w-full p-0">
                            @csrf
                            <button type="submit"
                                class="flex w-full p-2 px-3 gap-2 text-left text-error hover:bg-error/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</div>
