@extends('layouts.sidebar')

@section('title', 'Data Warga')

@section('content')
<div class="max-w-7xl mx-auto">

    <!-- Header Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Warga -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Warga</p>
                <h3 class="text-3xl font-black text-slate-800">{{ $totalWarga }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
        </div>

        <!-- Warga Aktif -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-emerald-500">
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Status Aktif</p>
                <h3 class="text-3xl font-black text-emerald-600">{{ $wargaAktif }}</h3>
            </div>
        </div>

        <!-- Warga Nonaktif -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-slate-400">
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Nonaktif / Pindah</p>
                <h3 class="text-3xl font-black text-slate-400">{{ $totalWarga - $wargaAktif }}</h3>
            </div>
        </div>
    </div>

    <!-- Content Card -->
    <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/50 border border-slate-100 overflow-hidden">

        <!-- Toolbar: Search & Title -->
        <div class="p-6 md:p-8 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Daftar Warga RT</h2>
                <p class="text-sm text-slate-500">Kelola data dan status keanggotaan warga.</p>
            </div>

            <form action="{{ route('rt.data_warga') }}" method="GET" class="w-full md:w-auto relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full md:w-72 pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-[#016B61] focus:border-transparent transition-all outline-none"
                    placeholder="Cari nama warga...">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>

                @if(request('search'))
                    <a href="{{ route('rt.data_warga') }}" class="absolute right-3 top-3 text-xs text-red-500 hover:underline">Reset</a>
                @endif
            </form>
        </div>

        <!-- Table List -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-100">
                        <th class="px-6 py-4 font-semibold">Nama Lengkap</th>
                        <th class="px-6 py-4 font-semibold">Kontak</th>
                        <th class="px-6 py-4 font-semibold">Alamat</th>
                        <th class="px-6 py-4 font-semibold text-center">Status</th>
                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($wargas as $warga)
                    <tr class="group hover:bg-emerald-50/30 transition-colors duration-200">
                        <!-- Kolom Nama & Email -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $warga->status == 'Aktif' ? 'from-emerald-100 to-emerald-200 text-[#016B61]' : 'from-slate-100 to-slate-200 text-slate-500' }} flex items-center justify-center font-bold text-sm shadow-sm">
                                    {{ substr($warga->nama, 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-700 {{ $warga->status == 'Nonaktif' ? 'line-through opacity-60' : '' }}">{{ $warga->nama }}</p>
                                    <p class="text-xs text-slate-400">{{ $warga->user->email ?? 'Email tidak tersedia' }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Kolom Kontak -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></path></svg>
                                <span class="font-mono">{{ $warga->no_hp }}</span>
                            </div>
                        </td>

                        <!-- Kolom Alamat -->
                        <td class="px-6 py-4">
                            <p class="text-sm text-slate-600 max-w-xs truncate" title="{{ $warga->alamat_rumah }}">
                                {{ $warga->alamat_rumah }}
                            </p>
                        </td>

                        <!-- Kolom Status -->
                        <td class="px-6 py-4 text-center">
                            @if($warga->status == 'Aktif')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Nonaktif
                                </span>
                            @endif
                        </td>

                        <!-- Kolom Aksi -->
                        <td class="px-6 py-4 text-right">
                            <div class="relative" x-data="{ open: false }">
                                <!-- Form Toggle Status -->
                                <form action="{{ route('rt.data_warga.status', $warga->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')

                                    @if($warga->status == 'Aktif')
                                        <button type="button" onclick="confirmDeactivate(this)" class="btn btn-sm btn-error btn-outline gap-2 group-hover:bg-red-500 group-hover:text-white hover:border-red-600 transition-all rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/></svg>
                                            Nonaktifkan
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-success btn-outline gap-2 group-hover:bg-emerald-500 group-hover:text-white hover:border-emerald-600 transition-all rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                            Aktifkan
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-600">Tidak ada warga ditemukan</h3>
                                <p class="text-slate-400 text-sm mt-1">Coba kata kunci lain atau belum ada warga yang terdaftar.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($wargas->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $wargas->links() }}
        </div>
        @endif
    </div>
</div>

{{-- Script SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDeactivate(button) {
        Swal.fire({
            title: 'Nonaktifkan Warga?',
            text: "Warga ini tidak akan bisa mengakses fitur layanan RT lagi.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', // Red
            cancelButtonColor: '#94a3b8', // Slate
            confirmButtonText: 'Ya, Nonaktifkan',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-3xl',
                confirmButton: 'rounded-xl px-6 py-2.5',
                cancelButton: 'rounded-xl px-6 py-2.5'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        })
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#016B61',
            timer: 2500,
            customClass: {
                popup: 'rounded-3xl',
                confirmButton: 'rounded-xl px-6 py-2.5'
            }
        });
    @endif
</script>
@endsection
