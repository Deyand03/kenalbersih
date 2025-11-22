<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('iurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained()->onDelete('cascade');
            $table->foreignId('rt_id')->constrained()->onDelete('cascade');
            $table->integer('jumlah_pembayaran');
            $table->text('no_pembayaran');
            $table->string('periode')->nullable();
            $table->enum('metode_pembayaran', ['Cash', "Digital"]);
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['Menunggu', "Diterima", "Ditolak"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iurans');
    }
};
