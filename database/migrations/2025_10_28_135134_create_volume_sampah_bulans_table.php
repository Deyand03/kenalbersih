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
        Schema::create('volume_sampah_bulans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_volume_tahun')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('bulan');
            $table->integer('organik');
            $table->integer('non_organik');
            $table->integer('b3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volume_sampah_bulans');
    }
};
