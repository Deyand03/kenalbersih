<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolumeSampahTahun extends Model
{
    protected $table = 'volume_sampah_tahuns';
    protected $guarded = [];

    public function rt(){
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }
    public function volume_sampah_bulan(){
        return $this->hasMany(VolumeSampahBulan::class, 'volume_tahun_id', 'id');
    }
}
