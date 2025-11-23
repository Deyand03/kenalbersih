<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LaporanKeuangan extends Model
{
    protected $table = 'laporan_keuangans';
    protected $fillable = [
        'rt_id',
        'judul',
        'deskripsi',
        'jumlah',
        'tanggal',
        'bukti_foto',
    ];

    public function rt(){
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }
    public function getBuktiFotoUrlAttribute()
    {
        // 1. Kalau gak ada foto, return null (atau gambar placeholder)
        if (!$this->bukti_foto) {
            return null;
            // atau return asset('images/no-image.png');
        }

        // 2. Cek apakah data di database sudah berupa URL lengkap (http...)
        // Ini jaga-jaga kalau nanti kamu pindah storage lagi
        if (str_starts_with($this->bukti_foto, 'http')) {
            return $this->bukti_foto;
        }

        // 3. Ambil URL dari Cloudinary
        $disk = Storage::disk('cloudinary');
        return $disk->url($this->bukti_foto);
    }
}
