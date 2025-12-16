<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    public static function send($target, $message)
    {
        $token = env('FONNTE_TOKEN');

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62', // Otomatis ubah 08 jadi 628
            ]);

            return $response->json();
        } catch (\Exception $e) {
            \Log::error("Fonnte Error: " . $e->getMessage());
            return null;
        }
    }
}
