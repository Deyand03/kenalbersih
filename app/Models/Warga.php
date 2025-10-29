<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'wargas';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function rt(){
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }

    public function iuran(){
        return $this->hasMany(Iuran::class, 'warga_id', 'id');
    }

    public function laporan_sampah(){
        return $this->hasMany(LaporanSampah::class, 'warga_id', 'id');
    }
}
