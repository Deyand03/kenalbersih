<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Pesan Otomatis
Route::get('/cron/run-reminder', function (Request $request) {
    $cronKey = env('CRON_PASS');

    if ($request->query('key') !== $cronKey) {
        abort(403, 'Unauthorized');
    }

    // 2. Jalankan Command Artisan
    try {
        $exitCode = Artisan::call('jadwal:send-reminder');
        $output = Artisan::output();

        Log::info("Cron Scheduler Result: " . $output);

        return response()->json([
            'status' => 'success',
            'message' => 'Scheduler executed successfully',
            'exit_code' => $exitCode,
            'output_preview' => substr($output, 0, 1000) . (strlen($output) > 1000 ? '...' : '')
        ]);

    } catch (\Exception $e) {
        Log::error("Cron Scheduler Error: " . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});
