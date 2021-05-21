<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKompetensi extends Model
{
    use HasFactory;
    protected $table = 'data_kompetensi';

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function capaian()
    {
        return $this->hasOne(IndikatorCapaian::class, 'id','capaian_id');
    }

}
