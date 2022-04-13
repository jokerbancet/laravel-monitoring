<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'nim',
        'jk',
        'agama',
        'alamat',
        'jurusan',
        'tahun_angkatan',
        'avatar'
    ];
    protected $appends = ['photo'];

    public function user()
    {
        // return $this->hasOne(User::class, 'user_id','id');
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function pemagangan()
    {
        $date = date('Y-m-d');
        return $this->hasOne(Pemagangan::class, 'mahasiswa_id','id')
            ->whereDate('mulai_magang', '<=', $date)
            ->whereDate('selesai_magang', '>=', $date);
    }

    public function pemagangans()
    {
        return $this->hasMany(Pemagangan::class, 'mahasiswa_id','id');
    }

    public function laporan()
    {
        return $this->hasOneThrough(Laporan::class, Pemagangan::class,'mahasiswa_id','id_data_bimbingan', 'id','id');
    }

    public function laporans()
    {
        return $this->hasManyThrough(Laporan::class, Pemagangan::class,'mahasiswa_id','id_data_bimbingan', 'id','id');
    }

    public function getAvatar($withAsset = true)
    {
        if (!$this->avatar) {
            return $withAsset?asset('images/default.png'):'images/default.png';
        }
        $avatar = file_exists(public_path('images/'.$this->avatar))?$this->avatar:'default.png';
        return $withAsset?asset('images/'.$avatar):'images/'.$avatar;
    }

    public function getPhotoAttribute()
    {
        $avatar = file_exists(public_path('images/'.$this->avatar))?$this->avatar:'default.png';
        return $avatar;
    }

    public function dosenpembimbing()
    {
        return $this->belongsToMany(DosenPembimbing::class, 'data_bimbingan', 'mahasiswa_id', 'dosenpembimbing_id')->withPivot(['mulai_magang', 'selesai_magang']);
    }

    public function pembimbingindustri()
    {
        return $this->belongsToMany(PembimbingIndustri::class, 'data_bimbingan', 'mahasiswa_id', 'pembimbingindustri_id')->withPivot(['mulai_magang','selesai_magang']);
    }

    // public function dataKompetensi()
    // {
    //     return $this->hasMany(DataKompetensi::class, 'mahasiswa_id', 'id');
    // }

    public function capaian()
    {
        return $this->hasMany(IndikatorCapaian::class, 'jurusan', 'jurusan');
    }
}
