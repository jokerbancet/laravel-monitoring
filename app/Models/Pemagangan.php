<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemagangan extends Model
{
    use HasFactory;
    protected $table = 'data_bimbingan';
    protected $fillable = [
        'mahasiswa_id',
        'dosenpembimbing_id',
        'pembimbingindustri_id',
        'mulai_magang',
        'selesai_magang',
        'jenis_pekerjaan',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'id','mahasiswa_id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_data_bimbingan','id');
    }

    public function kompetensi()
    {
        return $this->hasMany(DataKompetensi::class, 'mahasiswa_id','mahasiswa_id');
    }

    public function dosenPembimbing()
    {
        return $this->belongsTo(DosenPembimbing::class, 'dosenpembimbing_id','id');
    }

    public function pembimbingIndustri()
    {
        return $this->belongsTo(PembimbingIndustri::class, 'pembimbingindustri_id','id');
    }

    // public function industri()
    // {
    //     return $this->hasOneThrough(Industri::class,PembimbingIndustri::class,'id','industri_id','id','id');
    // }

}
