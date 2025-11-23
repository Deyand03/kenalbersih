<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LaporanSampah extends Model
{
    protected $table = 'laporan_sampahs';
protected $fillable = [
        'warga_id',
        'rt_id',
        'deskripsi',
        'alamat',
        'foto_bukti',
        'status',
    ];
    public function warga(){
        return $this->belongsTo(Warga::class, 'warga_id', 'id');
    }
    public function rt(){
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }
    public function getBuktiFotoUrlAttribute()
    {
        // 1. Kalau gak ada foto, return null (atau gambar placeholder)
        if (!$this->foto_bukti) {
            return null;
            // atau return asset('images/no-image.png');
        }

        // 2. Cek apakah data di database sudah berupa URL lengkap (http...)
        // Ini jaga-jaga kalau nanti kamu pindah storage lagi
        if (str_starts_with($this->foto_bukti, 'http')) {
            return $this->foto_bukti;
        }

        // 3. Ambil URL dari Cloudinary
        $disk = Storage::disk('cloudinary');
        return $disk->url($this->foto_bukti);
    }
}
