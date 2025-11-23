<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Iuran extends Model
{
    protected $table = 'iurans';
    protected $fillable = [
        'warga_id',
        'rt_id',
        'jumlah_pembayaran',
        'no_pembayaran',
        'periode',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status_pembayaran',
    ];

    public function warga(){
        return $this->belongsTo(Warga::class, 'warga_id', 'id');
    }
    public function rt(){
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }
    public function getBuktiPembayaranUrlAttribute()
    {
        // 1. Kalau gak ada foto, return null (atau gambar placeholder)
        if (!$this->bukti_pembayaran) {
            return null;
            // atau return asset('images/no-image.png');
        }

        // 2. Cek apakah data di database sudah berupa URL lengkap (http...)
        // Ini jaga-jaga kalau nanti kamu pindah storage lagi
        if (str_starts_with($this->bukti_pembayaran, 'http')) {
            return $this->bukti_pembayaran;
        }

        // 3. Ambil URL dari Cloudinary
        $disk = Storage::disk('cloudinary');
        return $disk->url($this->bukti_pembayaran);
    }

}
