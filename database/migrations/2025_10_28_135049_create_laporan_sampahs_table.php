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
        Schema::create('laporan_sampahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_warga')->constrained()->onDelete('cascade');
            $table->foreignId('id_rt')->constrained()->onDelete('cascade');
            $table->text('deskripsi');
            $table->string('alamat');
            $table->string('foto_bukti');
            $table->enum('status', ['Diajukan', "Diterima", "Selesai"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_sampahs');
    }
};
