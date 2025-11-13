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
        Schema::create('rts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('no_rt');
            $table->string('nama');
            $table->enum('jenis_kelamin', ["Laki-laki", "Perempuan"]);
            $table->string('no_rekening')->unique()->nullable();
            $table->string('alamat_rumah');
            $table->string('no_dana')->unique()->nullable();
            $table->string('no_hp')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rts');
    }
};
