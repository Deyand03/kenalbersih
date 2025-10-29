<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolumeSampahBulan extends Model
{
    protected $table = 'volume_sampah_bulans';

    protected $guarded = [];

    public function volume_sampah_tahun(){
        return $this->belongsTo(VolumeSampahTahun::class, 'volume_tahun_id', 'id');
    }
}
