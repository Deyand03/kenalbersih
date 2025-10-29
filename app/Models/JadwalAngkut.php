<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalAngkut extends Model
{
    protected $table = 'jadwal_angkuts';
    protected $guarded = [];

    public function rt(){
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }
}
