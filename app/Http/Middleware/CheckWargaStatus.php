<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckWargaStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->role === 'warga') {


            $status = $user->warga->status;

            if ($status === 'Non-aktif') {
                return redirect()->route('profile')
                    ->with('error', 'Akun Anda dinonaktifkan oleh RT. Silakan hubungi pengurus RT untuk mengaktifkan kembali akses layanan.');
            }

            if ($status === 'Pending') {
                return redirect()->route('profile')
                    ->with('warning', 'Akun Anda masih dalam status Pending. Mohon tunggu verifikasi dari RT untuk mengakses layanan ini.');
            }
        }
        return $next($request);
    }
}
