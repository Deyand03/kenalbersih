<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    protected $table = 'laporan_keuangans';
    protected $guarded = [];

    public function rt(){
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }
}
