<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanSampah extends Model
{
    protected $table = 'laporan_sampahs';
    protected $guarded = [];

    public function warga(){
        return $this->belongsTo(Warga::class, 'warga_id', 'id');
    }
    public function rt(){
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }
}
