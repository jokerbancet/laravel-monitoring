<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorCapaian extends Model
{
    use HasFactory;
    protected $table = 'master_capaian';
    protected $fillable = [
        'jurusan',
        'deskripsi_capaian',
        'kategori_capaian',
        'bobot_capaian',
    ];

    public function kompetensi()
    {
        return $this->hasOne(DataKompetensi::class, 'capaian_id','id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'capaian_id','id');
    }
}
