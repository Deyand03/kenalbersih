<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
