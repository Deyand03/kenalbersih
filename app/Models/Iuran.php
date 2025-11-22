<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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


}
