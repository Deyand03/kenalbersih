<div class="navbar fixed bg-transparent px-7 md:px-14 z-50 text-white navbar-custom">
    <div class="navbar-start">
        {{-- Tombol Mobile --}}
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost hover:btn-accent active:btn-accent mr-3 lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            {{-- Menu Dropdown Mobile --}}
            <ul tabindex="-1" class="menu menu-sm dropdown-content rounded-box z-1 mt-3 w-52 p-2 shadow dropdown-mobile bg-white/30">
                <li><a>Item 1</a></li>
                <li><a>Item 2</a></li>
                <li><a>Item 3</a></li>
            </ul>
        </div>

        {{-- Logo --}}
        <a class=""><span class="font-bold text-xl">Kenal</span><span class="font-bold text-xl web-name text-[#E1EEBC]">Bersih</span></a>
    </div>

    {{-- Menu Navigasi Desktop --}}
    <div class="navbar-center hidden lg:flex">
        <ul class="flex items-center gap-2 px-1 text-base font-medium space-x-2">
            <li>
                <a href="" class="relative group px-3 py-2">
                    <span>Homepage</span>
                    <span
                        class="absolute bottom-1.5 left-0 w-full h-0.5 bg-[#E1EEBC] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-out origin-left"></span>
                </a>
            </li>
            <li>
                <a href="" class="relative group px-3 py-2">
                    <span>[item2]</span>
                    <span
                        class="absolute bottom-1.5 left-0 w-full h-0.5 bg-[#E1EEBC] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-out origin-left"></span>
                </a>
            </li>
            <li>
                <a href="" class="relative group px-3 py-2">
                    <span>[item3]</span>
                    <span
                        class="absolute bottom-1.5 left-0 w-full h-0.5 bg-[#E1EEBC] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-out origin-left"></span>
                </a>
            </li>
            <li>
                <a href="" class="relative group px-3 py-2">
                    <span>[item4]</span>
                    <span
                        class="absolute bottom-1.5 left-0 w-full h-0.5 bg-[#E1EEBC] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-out origin-left"></span>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-end">
        <a href="" class="btn bg-(--bg-tertiary) px-5 shadow-md"><span class="font-semibold text-white">Login</span></a>
    </div>
</div>
