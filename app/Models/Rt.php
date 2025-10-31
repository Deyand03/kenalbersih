<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    protected $table = 'rts';

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function warga(){
        return $this->hasMany(Warga::class, 'rt_id', 'id');
    }

    public function iuran(){
        return $this->hasMany(Iuran::class, 'rt_id', 'id');
    }

    public function laporan_sampah(){
        return $this->hasMany(LaporanSampah::class, 'rt_id', 'id');
    }

    public function jadwal_angkut(){
        return $this->hasMany(JadwalAngkut::class, 'rt_id', 'id');
    }

    public function volume_sampah_tahun(){
        return $this->hasMany(VolumeSampahTahun::class, 'rt_id', 'id');
    }

    public function laporan_keuangan(){
        return $this->hasMany(LaporanKeuangan::class, 'rt_id', 'id');
    }
}
