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
        'prakerin_ke',
        'dosenpembimbing_id',
        'dosenpembimbing2_id',
        'pembimbingindustri_id',
        'mulai_magang',
        'selesai_magang',
        'jenis_pekerjaan',
        'laporan_weekend'
    ];

    public function getProgressAttribute()
    {
        $jam = $this->prakerin_ke==1?453:725;
        $laporan = $this->laporan->where('status_laporan', 'approve')->sum('durasi');
        return $laporan." / $jam jam";
    }

    public function getIsActiveAttribute()
    {
        $active = $this->mulai_magang<=date('Y-m-d')&&date('Y-m-d')<=$this->selesai_magang;
        return $active?'<span class="label label-primary">Sedang Magang</span>':'<span class="label label-success">Selesai Magang</span>';
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id','id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_data_bimbingan','id');
    }

    // public function kompetensi()
    // {
    //     return $this->hasMany(DataKompetensi::class, 'mahasiswa_id','mahasiswa_id');
    // }

    public function dosenPembimbing()
    {
        return $this->belongsTo(DosenPembimbing::class, 'dosenpembimbing_id','id');
    }

    public function dosenPembimbing2()
    {
        return $this->belongsTo(DosenPembimbing::class, 'dosenpembimbing2_id','id');
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
